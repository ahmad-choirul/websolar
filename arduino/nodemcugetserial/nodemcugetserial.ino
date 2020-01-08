#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <SoftwareSerial.h>
const char* host = "192.168.137.1/websolar/api";
String data;
HTTPClient http;
WiFiClient client;
const char* ssid = "wifi";
const char* password = "12345678";
int ledon = 2; //pin D4
int ledstat = 0; //pin D3
SoftwareSerial s(D6,D5);
void setup () {
  Serial.begin(115200);
    s.begin(115200);
  WiFi.begin(ssid, password);
    pinMode(ledon,OUTPUT);
  pinMode(ledstat,OUTPUT);
        digitalWrite(ledstat,LOW);
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

//void loop() {
//  if (Serial.available()) {
//    data = Serial.readString();
//  }
//  client.print(String("GET ") + data + " HTTP/1.1\n" + "Host: " + host + "\n" + "Connection: close\n\n");
//  Serial.print(data);
//  delay(3000);
//  unsigned long timeout = millis();
//  while (client.available() == 0) {
//    if (millis()-timeout>3000) {
//       Serial.println("client timeout");
//      client.stop();
//      return;
//    }
//  }
//}

void loop() {
  // put your main code here, to run repeatedly:
if (WiFi.status() == WL_CONNECTED){
    data = s.readString();
  HTTPClient http;
  http.begin(String("")+"http://192.168.137.1/websolar/api"+data);
      Serial.println(data);
  digitalWrite(ledstat,HIGH);
  int httpCode = http.GET();
  if (httpCode > 0){
      delay(1500);
    digitalWrite(ledstat,LOW);
    }
  http.end();
  }else{
    Serial.println("delay");
    delay(1500);
    }
     delay(1500);
}
