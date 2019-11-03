///yang fix
#include <Servo.h > // include Servo library 
#include <SoftwareSerial.h>
SoftwareSerial BTserial(2, 3); // RX | TX
#include <Wire.h> 
//#include <LiquidCrystal_I2C.h>
//LiquidCrystal_I2C lcd(0x27,20,4); 
    // 180 horizontal MAX
Servo vertical; // horizontal servo
int azimuth = 180; // 90;     // stand horizontal servo

int azimuthLimitHigh = 180;
int azimuthLimitLow = 0;

// 45 degrees MAX
Servo horizontal; // vertical servo 
int elevasi = 50; //   90;     // stand vertical servo

int elevasiLimitHigh = 50;
int elevasiLimitLow = 125;

// LDR pin connections
//  name  = analogpin;
//int ldrrd = A5; //LDR kanan bawah 
//int ldrrt = A4; //LDR kanan atas
//int ldrlt = A3; //ldr kiri atas
//int ldrld = A2; //LDR kiri bawah
//
int ldrrd = A2; //LDR kanan bawah 
int ldrrt = A3; //LDR kanan atas
int ldrlt = A4; //ldr kiri atas
int ldrld = A5; //LDR kiri bawah

int iterasi=0;
String str;
unsigned long previousMillis = 0;        // will store last time LED was updated

// constants won't change:
const long interval = 5000;           // interval at which to blink (milliseconds)
void setup() {
     Serial.begin(115200);
  BTserial.begin(115200);
    horizontal.attach(9);
    vertical.attach(10);
    horizontal.write(azimuth);
    vertical.write(elevasi);
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

    int tc = 100;
    int tol = 10;

    int rataatas = (lt + rt) / 2; // rata2 atas
    int ratabawah = (ld + rd) / 2; // rata2 bawah
    int ratakiri = (lt + ld) / 2; // rata2 kiri
    int ratakanan = (rt + rd) / 2; // rata2 kanan
    
//Serial.println(String()+"rataatas = "+rataatas+" ratabawah = "+ratabawah+" ratakiri = "+rataatas+" ratakanan = "+ratakanan);
    int error_vert = rataatas - ratabawah; // check beda  atas dan bawah
    int error_horizontal = ratakiri - ratakanan; // check beda  kiri and kanan
    Serial.println(String()+"Error vert = "+error_vert+" error hor = "+error_horizontal);
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
//String str = "/update?rataatas=" + String(rataatas) + "&ratabawah=" + String(ratabawah) + "&ratakanan=" + String(ratakanan)+ "&ratakiri=" + String(ratakiri)+ "&kd=" + String(tc)+ "&tol=" + String(tol);
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
        vertical.write(elevasi);
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
        horizontal.write(azimuth);
//        Serial.println(String()+"X = " + elevasi+" Y = " + azimuth);
    }
//          lcd.setCursor(0,0);
//  lcd.print(" X/Y || iterasi ");
//  lcd.setCursor(0,1);
//  lcd.print(String()+"" + elevasi+" " + azimuth);
//  lcd.print(" || ");
//  lcd.print(iterasi);
Serial.println(String()+"kiriatas = "+lt+" kananatas = "+rt+" kiribawah = "+ld+" kananbawah = "+rd);
Serial.println(String()+"elevasi = "+elevasi+" azimuth = "+azimuth+" iterasi = "+iterasi);
    delay(tc);
unsigned long currentMillis = millis();
     if (currentMillis - previousMillis >= interval) {
    previousMillis = currentMillis;
    BTserial.println(str);
      
  }
}
