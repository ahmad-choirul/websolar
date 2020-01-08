#include <ESP8266HTTPClient.h>
#include <ESP8266WiFi.h>
#include <SoftwareSerial.h>
#include <ArduinoJson.h>
SoftwareSerial s(D6,D5);
int ledon = 2; //pin D4
int ledstat = 0; //pin D3
const char* ssid = "wifi";
const char* password = "12345678";
void setup () {
  Serial.begin(115200);
  s.begin(115200);
  pinMode(ledon,OUTPUT);
  pinMode(ledstat,OUTPUT);
        digitalWrite(ledstat,LOW);
  WiFi.begin(ssid, password);
  Serial.print("Connecting..");
  while (WiFi.status() != WL_CONNECTED) {
    digitalWrite(ledon,HIGH);
    delay(500);
    digitalWrite(ledon,LOW);
    delay(500);
    Serial.print("..");
  }
      digitalWrite(ledon,HIGH);
}

String getValue(String data,char separator,int index){
  int found = 0;
  int strIndex[] ={0,0};
  int maxIndex = data.length()-1;
  for (int i=0; i<=maxIndex && found<=index;i++){
    if(data.charAt(i)==separator || i==maxIndex){
    found++;
    strIndex[0] = strIndex[1]+1;
    strIndex[1] = (i == maxIndex) ? i+1 :1;
    }
  }
  String ketemu = found>index ? data.substring (strIndex[0],strIndex[1]) : "";
  return ketemu;
 }
void loop() {
 
  // put your main code here, to run repeatedly:
if (WiFi.status() == WL_CONNECTED){
  HTTPClient http;
  http.begin("http://192.168.137.1/websolar/api/getsetpoint");
  digitalWrite(ledstat,HIGH);
  int httpCode = http.GET();
  if (httpCode > 0){
    String status = http.getString();
//    s.println(123);
    Serial.println(status);
//    Serial.print("sudut elevasi = ");
//    String data1 = getValue(status,',',0);
//    Serial.println(data1);
//    Serial.print("sudut azimuth = ");
//    String data2 = getValue(status,',',1);
//    Serial.println(data2);
//    Serial.print("elevasi = ");
//    String data3 = getValue(status,',',2);
//    Serial.println(data3);
//    Serial.print("azimuth = ");
//    String data4 = getValue(status,',',3);
//    Serial.println(data4);
//  StaticJsonBuffer<1000> jsonBuffer;
//  JsonObject& root = jsonBuffer.createObject();
//  root["sudut_elevasi"] = getValue(status,',',0);
//   root["sudut_azimuth"] = getValue(status,',',1);
//    root["elevasi"] = getValue(status,',',2);
//     root["azimuth"] = getValue(status,',',3);
//  if (s.available()>0){
//    root.printTo(s);
//    }
s.println(status);
    }
  http.end();
  }else{
    Serial.println("delay");
    }
    
    delay(1500);
    digitalWrite(ledstat,LOW);
     delay(1500);
  
}
