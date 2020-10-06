///yang fix
#include <Servo.h > // include Servo library 
#include <SoftwareSerial.h>
SoftwareSerial serialwifi(2, 3); // RX | TX
#include <Wire.h> 
#include <MPU6050.h>
MPU6050 mpu;
unsigned long timer = 0;
float timeStep = 0.01;
unsigned long Milliswifi = 0; //inisialisasi waktu kirim
// constants won't change :
const long intervalwifi = 3000;           // interval at which to blink (milliseconds)

// sudut_elevasi, sudut_azimuth and sudut_azimuth values
float sudut_elevasi = 0;
float sudut_azimuth = 0;
float yaw = 0;
Servo vertical; // horizontal servo
int azimuth = 180; // 90;     // stand horizontal servo
int setazimuth = 0; // 90;     // stand horizontal servo

int azimuthLimitHigh = 180;
int azimuthLimitLow = 0;

// 45 degrees MAX
Servo horizontal; // vertical servo 
int elevasi = 50; //   90;     // stand vertical servo
int setelevasi = 0; //   90;     // stand vertical servo
int elevasiLimitHigh = 50;
int elevasiLimitLow = 125;

// LDR pin connections
//  name  = analogpin;
//int ldrrd = A5; //LDR kanan bawah 
//int ldrrt = A4; //LDR kanan atas
//int ldrlt = A3; //ldr kiri atas
//int ldrld = A2; //LDR kiri bawah
//
int ldrrd = A0; //LDR kanan bawah 
int ldrrt = A1; //LDR kanan atas
int ldrlt = A2; //ldr kiri atas
int ldrld = A3; //LDR kiri bawah
    int tc = 100;
    int tol = 10;
int iterasi=0;
String str;
unsigned long previousMillis = 0;        // will store last time LED was updated

// constants won't change:
const long interval = 3000;           // interval at which to blink (milliseconds)
void setup() {
     Serial.begin(115200);
  serialwifi.begin(115200);
    horizontal.attach(9);
    vertical.attach(10);
    horizontal.write(azimuth);
    vertical.write(elevasi);
      Wire.begin();
  while (!mpu.begin(MPU6050_SCALE_2000DPS, MPU6050_RANGE_2G)) {
    Serial.println("Could not find a valid MPU6050 sensor, check wiring!");
    delay(500);
  }
  delay(2000);
//  mpu.calibrateGyro();
  delay(2000);
//     lcd.init();                      // initialize the lcd 
//  // Print a message to the LCD.
//  lcd.backlight();
// lcd.setCursor(0,0);
//  lcd.print("Solar Tracker");
//  lcd.setCursor(0,1);
//  lcd.print("Nila C.N.");
//    delay(1000);
}

void loop() {
//  lcd.clear();
    int lt = analogRead(ldrlt); // top left
    int rt = analogRead(ldrrt); // top right
    int ld = analogRead(ldrld); // down left
    int rd = analogRead(ldrrd); // down rigt
    
    int rataatas = (lt + rt) / 2; // rata2 atas
    int ratabawah = (ld + rd) / 2; // rata2 bawah
    int ratakiri = (lt + ld) / 2; // rata2 kiri
    int ratakanan = (rt + rd) / 2; // rata2 kanan
//Serial.println(String()+"kiriatas = "+lt+" kiribawah = "+ld+" kananatas = "+rt+" kananbawah = "+rd);    
//Serial.println(String()+"rataatas = "+rataatas+" ratabawah = "+ratabawah+" ratakiri = "+rataatas+" ratakanan = "+ratakanan);
    int error_vert = rataatas - ratabawah; // check beda  atas dan bawah
    int error_horizontal = ratakiri - ratakanan; // check beda  kiri and kanan
//    Serial.println(String()+"Error vert = "+error_vert+" error hor = "+error_horizontal);
//     lcd.setCursor(0,0);
//  lcd.print("Vert/Hor || X/Y");
//  lcd.setCursor(0,1);
//  lcd.print(error_vert);
//  lcd.print("/");
//  lcd.print(error_horizontal);
//  lcd.print(" || ");
//  lcd.print(elevasi);
//  lcd.print("/");
//  lcd.print(azimuth);

//str =String('0')+String(rataatas)+String('b')+String(ratabawah)+String('b')+String(ratakiri)+String('b')+String(ratakanan)+String('b')+String(tc)+String('b')+String(tol);
     timer = millis();

  // Read normalized values
  Vector norm = mpu.readNormalizeGyro();

  // Calculate sudut_elevasi, sudut_azimuth and sudut_azimuth
  sudut_elevasi = sudut_elevasi + norm.YAxis * timeStep;
  sudut_azimuth = sudut_azimuth + norm.XAxis * timeStep;
//  yaw = yaw + norm.ZAxis * timeStep;

  // Output raw
//  Serial.print(" sudut_elevasi = ");
//  Serial.print(sudut_elevasi);
//  Serial.print(" sudut_azimuth = ");
//  Serial.print(sudut_azimuth);

    if (-1 * tol > error_vert || error_vert > tol) // selisih rata2 atas dgn toleransi
    {
      iterasi++;
//      Serial.println(String()+"iterasi ke "+iterasi);
        if (rataatas > ratabawah) // perbandingan atas dn bawah
        {
            elevasi -=1;
            if (elevasi < elevasiLimitHigh) {
                elevasi = elevasiLimitHigh;
            }
        } else if (rataatas < ratabawah) {
            elevasi +=1;
            if (elevasi > elevasiLimitLow) {
                elevasi = elevasiLimitLow;
            }
        }else if (rataatas = ratabawah) {
        }
            if  (setelevasi!=elevasi){
       vertical.write(elevasi);
    setelevasi=elevasi;
}
//        Serial.println(String()+"X = " + elevasi+" Y = " + azimuth);
    }
    if (-1 * tol > error_horizontal || error_horizontal > tol) {
      iterasi++;
//      Serial.println(String()+"iterasi ke "+iterasi);
        if (ratakiri > ratakanan) {
            azimuth -=1;
            if (azimuth < azimuthLimitLow) {
                azimuth = azimuthLimitLow;
            }
        } else if (ratakiri < ratakanan) {
            azimuth +=1;
            if (azimuth > azimuthLimitHigh) {
                azimuth = azimuthLimitHigh;
            }
        } else if (ratakiri = ratakanan) {
        }
if  (setazimuth!=azimuth){
    horizontal.write(azimuth);
    setazimuth=azimuth;
}
    }
delay(tc);
String str = "/update/" + String(rataatas) + "X" + String(ratabawah) + "X" + String(ratakanan)+ "X" + String(ratakiri)+ "X" + String(sudut_elevasi)+ "X" + String(sudut_azimuth)+ "X" + String(elevasi)+ "X" + String(azimuth);
//    serialwifi.println(str);
//    Serial.println(str);
Serial.print(azimuth);
Serial.print(" / ");
Serial.println(elevasi);
unsigned long currentMillis = millis();

unsigned long Milliswifi = millis();
  if (currentMillis - previousMillis >= interval) {
    // save the last time you blinked the LED
    previousMillis = currentMillis;
    serialwifi.println(str);
  }
}
