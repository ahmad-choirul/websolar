#include <MPU6050.h>
#include <Wire.h>
#include <Servo.h > // include Servo library 
MPU6050 mpu;

// Timers
unsigned long timer = 0;
float timeStep = 0.01;
// Pitch, Roll and roll values
float pitch = 0;
float roll = 0;
float yaw = 0;
  Servo vertical; // horizontal servo
int azimuth = 0; // 90;     // stand horizontal servo

int azimuthLimitHigh = 180;
int azimuthLimitLow = 0;

// 45 degrees MAX
Servo horizontal; // vertical servo 
int elevasi = 50; //   90;     // stand vertical servo

int setpointservoroll = 90;
int setpointservopitch = 120;
int setpointroll = -40;
int setpointpitch = 25;
int elevasiLimitHigh = 50;
int elevasiLimitLow = 125;
int tol = 0;
boolean a=true;
boolean b = true;
void(* resetFunc) (void) = 0;

void setup()
{
  
    horizontal.attach(9);
    vertical.attach(10);
    horizontal.write(azimuth);
    vertical.write(elevasi);
  
Serial.begin(115200);
//  Serial.println(hasil);
   Wire.begin();
  while(!mpu.begin(MPU6050_SCALE_2000DPS, MPU6050_RANGE_2G))
  {
    Serial.println("Could not find a valid MPU6050 sensor, check wiring!");
    delay(500);
  }
  
  // Calibrate gyroscope. The calibration must be at rest.
  // If you don't want calibrate, comment this line.
  mpu.calibrateGyro();
delay(2000);
  // Set threshold sensivty. Default 3.
  // If you don't want use threshold, comment this line or set 0.
  // mpu.setThreshold(3);

//  int hasil = hitungpid(40,30);
//elevasi+=hasil;




}
 
void loop()
{
 timer = millis();

  // Read normalized values
  Vector norm = mpu.readNormalizeGyro();

  // Calculate Pitch, Roll and roll
  pitch = pitch + norm.YAxis * timeStep;
  roll = roll + norm.XAxis * timeStep;
  yaw = yaw + norm.ZAxis * timeStep;

  // Output raw
  Serial.print(" Pitch = ");
  Serial.print(pitch);
  Serial.print(" Roll = ");
  Serial.print(roll);  
  Serial.print(" yaw = ");
  Serial.print(yaw);

  // Wait to full timeStep period
  delay((timeStep*1000) - (millis() - timer));
//   if (pitch < setpointpitch - tol || pitch > setpointpitch + tol){ // selisih rata2 atas dgn toleransi
  if  (pitch<setpointpitch){
elevasi++;
    }else if  (pitch>setpointpitch){
elevasi--;
      }
//}
else{
  a=false;
  }


      if (elevasi < elevasiLimitHigh) {
                elevasi = elevasiLimitHigh;
            }
            if (elevasi > elevasiLimitLow) {
                elevasi = elevasiLimitLow;
            }
                 Serial.print(" elevasi = ");
  Serial.print(elevasi);
           vertical.write(elevasi);
//            if (roll < setpointroll - tol || roll > setpointroll + tol){ // selisih rata2 atas dgn toleransi
  if  (roll<setpointroll){
    azimuth++;
    }else if(roll>setpointroll){
      azimuth--;
      }
//}
else{
  b=false;
  }
           if (azimuth < azimuthLimitLow) {
                azimuth = azimuthLimitLow;
            }
 if (azimuth > azimuthLimitHigh) {
                azimuth = azimuthLimitHigh;
            }
            Serial.print(" azimuth = ");
  Serial.print(azimuth);

             horizontal.write(azimuth);
             Serial.println();
if (pitch>500||roll>500||yaw>500)
resetFunc();
//if (!a&&!b)
//exit(0);
}

  
