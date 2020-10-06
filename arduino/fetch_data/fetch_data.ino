#include <ESP8266HTTPClient.h>
#include <ESP8266WiFi.h>
#include <SoftwareSerial.h>
SoftwareSerial s(D6,D5); //RX TX
int ledon = 2; //pin D4
int ledstat = 0; //pin D3
const char* ssid = "wifi";
const char* password = "12345678";
String status="-94.07X634.41X87X124";
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

if (WiFi.status() == WL_CONNECTED){
  HTTPClient http;
  http.begin(String("")+"http://192.168.137.1/websolar/api/getsetpoint/" + status+"X2");
  Serial.println(String("")+"http://192.168.137.1/websolar/api/getsetpoint/" + status+"X2");
  digitalWrite(ledstat,HIGH);
  int httpCode = http.GET();
  if (httpCode > 0){
    status = http.getString();
    Serial.println(status);
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
