#include <Wire.h>

#include <Servo.h > // include Servo library
#include <SoftwareSerial.h>
SoftwareSerial serialwifi(5, 6); // RX | TX

// Timers
unsigned long timer = 0;
float timeStep = 0.01;
// Pitch, Roll and roll values
float pitch = 0;
float roll = 0;
Servo vertical; // horizontal servo
int azimuth = 0; // 90;     // stand horizontal servo

int azimuthLimitHigh = 180;
int azimuthLimitLow = 0;

// 45 degrees MAX
Servo horizontal; // vertical servo 
int elevasi = 50; //   90;     // stand vertical servo

int setpointsudut_azimuth = 82; 
int setpointsudut_elevasi = 127;
int elevasiLimitHigh = 50;
int elevasiLimitLow = 125;
int tol = 0;
boolean a = true;
boolean b = true;
void( * resetFunc)(void) = 0;

void setup() {

  horizontal.attach(9);
  vertical.attach(10);
  horizontal.write(azimuth);
  vertical.write(elevasi);

    serialwifi.begin(115200);
  Serial.begin(115200);
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

  if (serialwifi.available()) {
    String a = serialwifi.readString();
    Serial.println(a);
setpointsudut_elevasi = getValue(a,'X',0).toInt();
setpointsudut_azimuth = abs(getValue(a,'X',1).toInt()-180);
    Serial.print("setpint sudut_elevasi = ");
Serial.println(setpointsudut_elevasi);
    Serial.print("setpint sudut_azimuth = ");
Serial.println(setpointsudut_azimuth);
  }
  
  timer = millis();
  delay((timeStep * 1000) - (millis() - timer));
  if (elevasi < setpointsudut_elevasi) {
    elevasi++;
  } else if (elevasi > setpointsudut_elevasi) {
    elevasi--;
  }
  //}
  else {
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
}
