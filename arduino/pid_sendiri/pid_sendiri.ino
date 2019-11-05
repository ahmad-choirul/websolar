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
// Pitch, Roll and roll values
float pitch = 0;
float roll = 0;
float yaw = 0;
float pastpitch = 0;
float pastroll = 0;
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
int setpointroll = -60;
int setpointpitch = 60;
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
    delay((timeStep * 1000) - (millis() - timer));
    if (pitch < setpointpitch - tol || pitch > setpointpitch + tol) { // selisih rata2 atas dgn toleransi
        int hasil = hitungpid(pitch, pastpitch, setpointpitch);
        Serial.print(" pitch = ");
        Serial.print(hasil);
        pastpitch = setpointpitch - pitch;
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
    if (roll < setpointroll - tol || roll > setpointroll + tol) { // selisih rata2 atas dgn toleransi
        int hasil = hitungpid(roll, pastroll, setpointroll);
        Serial.print(" roll = ");
        Serial.print(hasil);
        pastroll = setpointroll - roll;
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
    if (pitch > 500 || roll > 500 || yaw > 500)
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
    int outnya = presentase / 5;
    return outnya;
}
