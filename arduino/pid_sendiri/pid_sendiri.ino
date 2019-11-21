#include <MPU6050.h>
#include <Wire.h>
#include <Servo.h > // include Servo library
MPU6050 mpu;
double ts = 0.05;
double kp = 0.9;
double Ti = 0.3;
double Td = 1;
// double setpoint = 90;
// Timers
unsigned long timer = 0;
float timeStep = 0.01;
// sudut_elevasi, sudut_azimuth and sudut_azimuth values
float sudut_elevasi = 0;
float  = 0;
float yaw = 0;
float pastsudut_elevasi = 0;
float pastsudut_azimuth = 0;
float pastyaw = 0;
boolean arah = false;
int gerak = 0;
Servo vertical; // horizontal servo
int azimuth = 0; // 90;     // stand horizontal servo
int azimuthLimitHigh = 180;
int azimuthLimitLow = 0;
// 45 degrees MAX
Servo horizontal; // vertical servo
int elevasi = 50; //   90;     // stand vertical servo
int setpointsudut_azimuth = -25;
int setpointsudut_elevasi = 5;
int elevasiLimitHigh = 50;
int elevasiLimitLow = 125;
int tol = 0;
void (*resetFunc)(void) = 0;

void setup()
{
    horizontal.attach(9);
    vertical.attach(10);
    horizontal.write(azimuth);
    vertical.write(elevasi);
    Serial.begin(115200);
    //  Serial.println(hasil);
    Wire.begin();
    while (!mpu.begin(MPU6050_SCALE_2000DPS, MPU6050_RANGE_2G)) {
        Serial.println("Could not find a valid MPU6050 sensor, check wiring!");
        delay(500);
    }
    // Calibrate gyroscope. The calibration must be at rest.
    // If you don't want calibrate, comment this line.
    mpu.calibrateGyro();
    delay(2000);
}

void loop()
{
    timer = millis();
    // Read normalized values
    Vector norm = mpu.readNormalizeGyro();

    // Calculate sudut_elevasi, sudut_azimuth and sudut_azimuth
    sudut_elevasi = sudut_elevasi + norm.YAxis * timeStep;
    sudut_azimuth = sudut_azimuth + norm.XAxis * timeStep;
    yaw = yaw + norm.ZAxis * timeStep;
    // Output raw
    Serial.print(" sudut_elevasi = ");
    Serial.print(sudut_elevasi);
    Serial.print(" sudut_azimuth = ");
    Serial.print(sudut_azimuth);
    Serial.print(" yaw = ");
    Serial.print(yaw);
    // Wait to full timeStep period
    delay((timeStep * 1000) - (millis() - timer));
    if (sudut_elevasi < setpointsudut_elevasi - tol || sudut_elevasi > setpointsudut_elevasi + tol) { // selisih rata2 atas dgn toleransi
        int hasil = hitungpid(sudut_elevasi, pastsudut_elevasi, setpointsudut_elevasi);
        Serial.print(" sudut_elevasi = ");
        Serial.print(hasil);
        pastsudut_elevasi = setpointsudut_elevasi - sudut_elevasi;
        elevasi += hasil;
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
        int hasil = hitungpid(sudut_azimuth, pastsudut_azimuth, setpointsudut_azimuth);
        Serial.print(" sudut_azimuth = ");
        Serial.print(hasil);
        pastsudut_azimuth = setpointsudut_azimuth - sudut_azimuth;
        azimuth -= hasil;
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
    if (sudut_elevasi > 500 || sudut_azimuth > 500 || yaw > 500)
        resetFunc();
}

int hitungpid(int feedback, int errorsebelum, int setpoint)
{
    int error = setpoint - feedback; 
    double errorI = (((error + errorsebelum) / 2) * ts) + errorsebelum;
    double errorD = ((error - errorsebelum) / 2) * ts;
    double outP = kp * error;
    double outI = (kp / Ti) * errorI;
    double outD = (kp * Td) * errorD;
    double outPID = outP + outI + outD;
    double presentase = (outPID / 729) * 100;
    Serial.print((String) " presentase = " + presentase);
    int outnya = presentase / 2;
    return outnya;
}
