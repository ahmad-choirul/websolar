
int vnb = 10; //value negatif big
      int vnm = 6; //value negatif medium
      int vns = 2; //value negatif small
      int vz = 0; //value zero
      int vps = -2; //value positif small
      int vpm = -6; //value positif medium
      int vpb = -10; //value positif big
      int nba = -125; //batas atas negatif big
      int nbb = -1024; //batas bawah negatif big
      int nma = -50; //batas atas negatif medium
      int nmb = -275; //batas bawah negatif medium
      int nsa = 10; //batas atas negatif small
      int nsb = -125; //batas bawah negatif small
      int za = 50; //batas atas zero
      int zb = -50; //batas bawah zero
     int psa = 125; //batas atas positif small
     int psb = 10; //batas bawah positif small
     int pma = 275; //batas atas positif medium
     int pmb = 50; //batas bawah positif medium
     int pba = 1024; //batas atas positif big
     int pbb = 125; //batas bawah positif big
     int domnb = -275;
     int domnm = -125;
     int domns = -50;
     int domz = 0;
     int domps = 50;
     int dompm = 125;
     int dompb = 275;
     
    boolean awal = true;
    boolean tampilserial = false;
 int de = 0;
    int ce = 0;
    int pe = 0;
    String statrangeE[2];
    String statrangeDE[2];
    double alfae[2];
    double alfade[2];
    double combine[4];
    int range[2];
    int statarray = 0;
    String txt = "";


#include <Servo.h > // include Servo library 
#include <SoftwareSerial.h>
SoftwareSerial BTserial(2, 3); // RX | TX
#include <Wire.h> 
//#include <MPU6050.h>
//MPU6050 mpu;
//unsigned long timer = 0;
//float timeStep = 0.01;
//// Pitch, Roll and roll values
//float pitch = 0;
//float roll = 0;
//float yaw = 0;
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
int ldrrd = A2; //LDR kanan bawah 
int ldrrt = A3; //LDR kanan atas
int ldrlt = A4; //ldr kiri atas
int ldrld = A5; //LDR kiri bawah
int iterasi=0;
String str;
unsigned long previousMillis = 0;        // will store last time LED was updated
// constants won't change:
const long interval = 5000;           // interval at which to blink (milliseconds)
    int tc = 200;
    int tol = 10;
int outvert = 0;
    int outhor = 0;
void setup() {
  // put your setup code here, to run once:
Serial.begin(9600);
  BTserial.begin(9600);
    horizontal.attach(9);
    vertical.attach(10);
    horizontal.write(azimuth);
    vertical.write(elevasi);
//     lcd.init();                      // initialize the lcd 
  // Print a message to the LCD.
//  lcd.backlight();
// lcd.setCursor(0,0);
//  lcd.print("Solar Tracker");
//  lcd.setCursor(0,1);
//  lcd.print("Nila C.N.");
//    while (!mpu.begin(MPU6050_SCALE_2000DPS, MPU6050_RANGE_2G)) {
//    Serial.println("Could not find a valid MPU6050 sensor, check wiring!");
//    delay(500);
//  }
//  delay(2000);
//  mpu.calibrateGyro();
//  delay(2000);
}

void loop() {
    int lt = analogRead(ldrlt); // top left
    int rt = analogRead(ldrrt); // top right
    int ld = analogRead(ldrld); // down left
    int rd = analogRead(ldrrd); // down rigt
    int rataatas = (lt + rt) / 2; // rata2 atas
    int ratabawah = (ld + rd) / 2; // rata2 bawah
    int ratakiri = (lt + ld) / 2; // rata2 kiri
    int ratakanan = (rt + rd) / 2; // rata2 kanan
    int error_vert = rataatas - ratabawah; // check beda  atas dan bawah
    int error_horizontal = ratakiri - ratakanan; // check beda  kiri and kanan

//      timer = millis();
//
//  // Read normalized values
//  Vector norm = mpu.readNormalizeGyro();
//
//  // Calculate Pitch, Roll and roll
//  pitch = pitch + norm.YAxis * timeStep;
//  roll = roll + norm.XAxis * timeStep;
//  yaw = yaw + norm.ZAxis * timeStep;
//
//  // Output raw
//  Serial.print(" Pitch = ");
//  Serial.print(pitch);
//  Serial.print(" Roll = ");
//  Serial.print(roll);


 if (-1 * tol > error_vert || error_vert > tol) // selisih rata2 atas dgn toleransi
    {
      if (error_vert>275){
  outvert=10;
  }
  else if(error_vert<-275){
    outvert=-10;
    }else{
    tampilserial = true;
outvert = hitungfuzzy(error_vert);   
  }
    }
  else{
outvert = 0;  
    }
elevasi -=outvert;
 if (elevasi < elevasiLimitHigh) {
                elevasi = elevasiLimitHigh;
            }
            if (elevasi > elevasiLimitLow) {
                elevasi = elevasiLimitLow;
            }
           vertical.write(elevasi);

if (-1 * tol > error_horizontal || error_horizontal > tol) {

tampilserial = true;
if (error_horizontal>275){
  outhor=10;
  }
  else if(error_horizontal<-275){
    outhor=-10;
    }
  else{
    outhor = hitungfuzzy(error_horizontal);
    }
  }
  else{
  outhor = 0;
    }
azimuth-=outhor;
if (azimuth < azimuthLimitLow) {
                azimuth = azimuthLimitLow;
            }
 if (azimuth > azimuthLimitHigh) {
                azimuth = azimuthLimitHigh;
            }
horizontal.write(azimuth);
if (tampilserial){
  iterasi++;
Serial.println(String()+"kiriatas = "+lt+" kananatas = "+rt+" kiribawah = "+ld+" kananbawah = "+rd);
//Serial.println(String()+"errorvert = "+error_vert+" error_horizontal = "+error_horizontal);
Serial.println(String()+"outvert = "+outvert+" outhor = "+outhor+"elevasi = "+elevasi+" azimuth = "+azimuth+" iterasi = "+iterasi);
}
tampilserial=false;
    delay(tc);
//unsigned long currentMillis = millis();
//     if (currentMillis - previousMillis >= interval) {
//    previousMillis = currentMillis;
//    BTserial.println(str);
//  }

}
int hitungfuzzy(int ce){
  if (awal){
    awal=false;
    de=ce;
  }
        cekrange(ce,'E');
        if (statrangeE[1] !=  ' ') {
            alfae[0] = (double)abs((ce - range[1])) /abs((range[0] - range[1]));
            alfae[1] = (double)abs(ce - range[0]) /abs(range[0] - range[1]);
        } else {
            alfae[0] = (double)abs((de - range[1])) /abs((range[0] - range[1]));
        }
        statarray = 0;
        cekrange(de, 'D');
        if (statrangeDE[1] != ' ') {
            alfade[0] = (double)abs((de - range[1])) /abs((range[0] - range[1]));
            alfade[1] = (double)abs(de - range[0]) /abs(range[0] - range[1]);
        } else {
            alfade[0] = (double)abs((de - range[1])) /abs((range[0] - range[1]));
        }
        double totalkalicombine = 0;
        double totaljumlahcombine = 0;
        if (statrangeE[1] != ' ') {
            if (statrangeDE[1] !=  ' ') {
                int count = 0;
                for (int i = 0; i < 2; i++) {
                    for (int j = 0; j < 2; j++) {
                        combine[count++] = max(alfae[i], alfade[j]);
                        totalkalicombine += (combine[count - 1] * (controlrulebase(statrangeE[i], statrangeDE[j])));
                      totaljumlahcombine =totaljumlahcombine + combine[count - 1];
                    }
                }
            } else {
                for (int j = 0; j < 2; j++) {
                    combine[j] = max(alfae[j], alfade[0]);
                    totalkalicombine += (combine[j] * (controlrulebase(statrangeE[j], statrangeDE[0])));    
             totaljumlahcombine =totaljumlahcombine + combine[j];
                }
            }
        } else {//e=1 de=2
    Serial.print("e=1 dan de=2");
            if (de == 0) {//awal perhitungan saat de =0 
                totalkalicombine = 0;
            } else {
                for (int j = 0; j < 2; j++) {
                    combine[j] = max(alfae[0], alfade[j]);
                    totalkalicombine += (combine[j] * (controlrulebase(statrangeE[0], statrangeDE[j])));
                       totaljumlahcombine = totaljumlahcombine + combine[j];
                }
            }
        }
      Serial.println();
                  int outfuzzy = (totalkalicombine / totaljumlahcombine);
         if (outfuzzy<10||outfuzzy>-10){
          if (outfuzzy>0){
            outfuzzy+= 1;
            }else{
              outfuzzy-= 1;
              }
          }
          Serial.print(outfuzzy);
        statarray = 0;
        statrangeE[0] = ' ';
        statrangeE[1] = ' ';
        statrangeE[0] = ' ';
        statrangeE[1] = ' ';
        de = ce;
        return outfuzzy;
    }

   void cekrange(int value, char pilih) {
    String stat[2];
        
      if (pilih=='E'){
       if (pba > value && value > pbb) {
            statrangeE[statarray] = "pb";
            range[statarray] = dompb;
            statarray++;
        }
        if (pma > value && value > pmb) {
            statrangeE[statarray] = "pm";
            range[statarray] = dompm;
            statarray++;
        }
        if (psa > value && value > psb) {
            statrangeE[statarray] = "ps";
            range[statarray] = domps;
            statarray++;
        }
        if (za > value && value > zb) {
            statrangeE[statarray] = "ze";
            range[statarray] = domz;

            statarray++;
        }
        if (nba > value && value > nbb) {
            statrangeE[statarray] = "nb";
            range[statarray] = domnb;
            statarray++;
        }
        if (nma > value && value > nmb) {
            statrangeE[statarray] = "nm";
            range[statarray] = domnm;
            statarray++;
        }
        if (nsa > value && value > nsb) {
            statrangeE[statarray] = "ns";
            range[statarray] = domns;
            statarray++;
        }
        }else{
           if (pba > value && value > pbb) {
            statrangeDE[statarray] = "pb";
            range[statarray] = dompb;
            statarray++;
        }
        if (pma > value && value > pmb) {
            statrangeDE[statarray] = "pm";
            range[statarray] = dompm;
            statarray++;
        }
        if (psa > value && value > psb) {
            statrangeDE[statarray] = "ps";
            range[statarray] = domps;
            statarray++;
        }
        if (za > value && value > zb) {
            statrangeDE[statarray] = "ze";
            range[statarray] = domz;
            statarray++;
        }
        if (nba > value && value > nbb) {
            statrangeDE[statarray] = "nb";
            range[statarray] = domnb;
            statarray++;
        }
        if (nma > value && value > nmb) {
            statrangeDE[statarray] = "nm";
            range[statarray] = domnm;
            statarray++;
        }
        if (nsa > value && value > nsb) {
            statrangeDE[statarray] = "ns";
            range[statarray] = domns;
            statarray++;
        }
          }
    }

    int controlrulebase(String error, String deltaerror) {
        
        String rang[] = {"nb", "nm", "ns", "ze", "ps", "pm", "pb"};
        int nilairang[] = {-10, -6, -2, 0, 2, 6, 10};
        String namarange[7][7] = {{"nb", "nb", "nb", "nb", "nm", "ns", "ze"}, 
                                {"nb", "nb", "nm", "nm", "ns", "ze", "ps"}, 
                                {"nb", "nm", "ns", "ns", "ze", "ps", "pm"},
                                {"nb", "nm", "ns", "ze", "ps", "pm", "pb"},
                                {"nm", "ns", "ze", "ps", "ps", "pb", "pb"},
                                {"ns", "ze", "ps", "pm", "pb", "pb", "pb"}, 
                                {"ze", "ps", "pm", "pb", "pb", "pb", "pb"}};
        int ang1 = 0, ang2 = 0;
        for (int i = 0; i < sizeof(namarange); i++) {
            if (error.equalsIgnoreCase(rang[i])) {
                ang1 = i;
            }
            if (deltaerror.equalsIgnoreCase(rang[i])) {
                ang2 = i;
            }
        }
        int nilairulebase = 0;
        for (int i = 0; i < sizeof(rang); i++) {
            if (namarange[ang1][ang2].equalsIgnoreCase(rang[i])) {
                nilairulebase = nilairang[i];
            }
        }
Serial.print(namarange[ang1][ang2]);
        return nilairulebase;
    }
