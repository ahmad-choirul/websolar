#include <Wire.h>
#include <MPU6050.h>
#include <Servo.h > // include Servo library
MPU6050 mpu;
#include <SoftwareSerial.h>
double ts = 0.05;
double kp = 0.9;
double Ti = 1;
double Td = 1;
unsigned long timer = 0;
float timeStep = 0.01;
float sudut_elevasi = 0;  
float  sudut_azimuth= 0;
float pastsudut_elevasi = 0;
float pastsudut_azimuth = 0;
int hasil1;
int hasil2;
SoftwareSerial serialwifi(5, 6); // RX | TX
const int buttonPin = 12; // pin baca button
int setpointsudut_azimuth = 0;
int azimuth = 0; // 90;     // stand horizontal servo
int azimuthLimitHigh = 180;
int azimuthLimitLow = 0;

int setpointsudut_elevasi = 50;
int elevasi = 50; //   90;     // stand vertical servo
int elevasiLimitHigh = 50;
int elevasiLimitLow = 125;
Servo horizontal; // vertical servo 
Servo vertical; // horizontal servo
int buttonState = 0; // variable for reading the pushbutton status
int tol = 0;
boolean a = true;
boolean b = true;
boolean nilaipid = false;
void (*resetFunc)(void) = 0;
void setup() {
  horizontal.attach(9);
  vertical.attach(10);
  horizontal.write(0);
  vertical.write(50);
  serialwifi.begin(115200);
  Serial.begin(115200);
  // initialize the pushbutton pin as an input:
  pinMode(buttonPin, INPUT_PULLUP);
  Wire.begin();
  while (!mpu.begin(MPU6050_SCALE_2000DPS, MPU6050_RANGE_2G)) {
    Serial.println("Could not find a valid MPU6050 sensor, check wiring!");
    delay(500);
  }
  // Calibrate gyroscope. The calibration must be at rest.
  // If you don't want calibrate, comment this line.
  mpu.calibrateGyro();
  delay(3000);
}


String getValue(String data, char separator, int index)
{
  int found = 0;
  int strIndex[] = {0, -1};
  int maxIndex = data.length()-1;

  for(int i=0; i<=maxIndex && found<=index; i++){
    if(data.charAt(i)==separator || i==maxIndex){
        found++;
        strIndex[0] = strIndex[1]+1;
        strIndex[1] = (i == maxIndex) ? i+1 : i;
    }
  }

  return found>index ? data.substring(strIndex[0], strIndex[1]) : "";
}
void loop() {
  // read the state of the pushbutton value:
  buttonState = digitalRead(buttonPin);

  // check if the pushbutton is pressed. If it is, the buttonState is HIGH:
  if (buttonState == HIGH) { // PID hidup
    pid();
  } else { //PID mati
    aktuator();
  }
}
void aktuator() {
  if (serialwifi.available()) {
    String a = serialwifi.readString();
    Serial.println(a);
    setpointsudut_elevasi = getValue(a, 'X', 0).toInt();
    setpointsudut_azimuth = abs(getValue(a, 'X', 1).toInt() - 180);
    Serial.print("setpint sudut_elevasi = ");
    Serial.println(setpointsudut_elevasi);
    Serial.print("setpint sudut_azimuth = ");
    Serial.println(setpointsudut_azimuth);
  }
  if (elevasi < setpointsudut_elevasi) {
    elevasi++;
  } else if (elevasi > setpointsudut_elevasi) {
    elevasi--;
  } else {
    a = false;
  }

  if (elevasi < elevasiLimitHigh) {
    elevasi = elevasiLimitHigh;
  }
  if (elevasi > elevasiLimitLow) {
    elevasi = elevasiLimitLow;
  }
  vertical.write(elevasi);
  if (azimuth < setpointsudut_azimuth) {
    azimuth++;
  } else if (azimuth > setpointsudut_azimuth) {
    azimuth--;
  } else {
    b = false;
  }
  if (azimuth < azimuthLimitLow) {
    azimuth = azimuthLimitLow;
  }
  if (azimuth > azimuthLimitHigh) {
    azimuth = azimuthLimitHigh;
  }
  horizontal.write(azimuth);
  delay(10);
}

void pid() {
  timer = millis();
  Vector norm = mpu.readNormalizeGyro();
  // hitung sudut_elevasi, sudut_azimuth
  sudut_elevasi = sudut_elevasi + norm.YAxis * timeStep;
  sudut_azimuth = sudut_azimuth + norm.XAxis * timeStep;
  if (nilaipid==false){
      setpointsudut_elevasi = sudut_elevasi + norm.YAxis * timeStep;
  setpointsudut_azimuth = sudut_azimuth + norm.XAxis * timeStep;
  nilaipid=true;
    }
  // Output raw
  Serial.print(" sudut_elevasi = ");
  Serial.print(sudut_elevasi);
  Serial.print(" sudut_azimuth = ");
  Serial.print(sudut_azimuth);
  // Wait to full timeStep period
  delay((timeStep * 1000) - (millis() - timer));
  if (sudut_elevasi < setpointsudut_elevasi - tol || sudut_elevasi > setpointsudut_elevasi + tol) { // selisih rata2 atas dgn toleransi
    hasil1 = hitungpid(sudut_elevasi, pastsudut_elevasi, setpointsudut_elevasi);
    Serial.print(" out elevasi = ");
    Serial.print(hasil1);
    pastsudut_elevasi = setpointsudut_elevasi - sudut_elevasi;
    elevasi += hasil1;
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
  if (sudut_azimuth < setpointsudut_azimuth - tol || sudut_azimuth > setpointsudut_azimuth + tol) { // selisih rata2 atas dgn toleransi
    hasil2 = hitungpid(sudut_azimuth, pastsudut_azimuth, setpointsudut_azimuth);
    Serial.print(" out azimuth = ");
    Serial.print(hasil2);
    pastsudut_azimuth = setpointsudut_azimuth - sudut_azimuth;
    azimuth -= hasil2;
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
  if (sudut_elevasi > 500 || sudut_azimuth > 500)
    resetFunc();
}

int hitungpid(int feedback, int errorsebelum, int setpoint) {
  int error = setpoint - feedback;
  double errorI = (((error + errorsebelum) / 2) * ts) + errorsebelum;
  double errorD = ((error - errorsebelum) / 2) * ts;
  double outP = kp * error;
  double outI = (kp / Ti) * errorI;
  double outD = (kp * Td) * errorD;
  double outPID = outP + outI + outD;
  double presentase = (outPID / 729) * 100;
  Serial.print((String)
    " presentase = " + presentase);
  int outnya = presentase;
  return outnya;
}
