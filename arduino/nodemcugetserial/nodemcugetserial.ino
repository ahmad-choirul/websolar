#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <SoftwareSerial.h>
const char* host = "192.168.137.1/websolar/api";
String data;
HTTPClient http;
WiFiClient client;
const char* ssid = "wifi";
const char* password = "12345678";
int ledon = 14; //pin D5
int ledstat = 12; //pin D6
SoftwareSerial serialarduino(D2, D3); // RX | TX
void setup () {
  Serial.begin(115200);
    serialarduino.begin(115200);
  WiFi.begin(ssid, password);
    pinMode(ledon,OUTPUT);
     pinMode(ledstat,OUTPUT);
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


void loop() {
if (WiFi.status() == WL_CONNECTED){
    if(serialarduino.available()>0){
      data = serialarduino.readString();
      }
  HTTPClient http;
  http.begin(String("")+"http://192.168.137.1/websolar/api"+data);
      Serial.println(data);
  digitalWrite(ledstat,HIGH);
  int httpCode = http.GET();
  if (httpCode > 0){
      delay(1500);
    }
  http.end();
  }else{
    Serial.println("delay");
    delay(1500);
    }
    
    digitalWrite(ledstat,LOW);
     delay(1500);
}
