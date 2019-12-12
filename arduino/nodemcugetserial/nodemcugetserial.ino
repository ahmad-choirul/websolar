#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

const char* host = "192.168.137.1/websolar";
String data;
HTTPClient http;
WiFiClient client;
const char* ssid = "wifi";
const char* password = "12345678";

void setup () {
  Serial.begin(115200);
  WiFi.begin(ssid, password);
  Serial.print("Connecting..");
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.print("..");
  }
  while (!Serial) {
    ; // wait for serial port to connect. Needed for native USB port only
  }
}
//void loop() {
//  if (Serial.available()) {
//    Serial.write(Serial.read());
//    HTTPClient http;  //Declare an object of class HTTPClient
//    String a = Serial.readString();
//     String url= "http://test3.ifpi.or.id/public/update/"+a;
//     Serial.readString();
//    http.begin(url);  //Specify request destination
////    Serial.println(url);
//    int httpCode = http.GET();                                                                  //Send the request
//
//    if (httpCode > 0) { //Check the returning code
//      String payload = http.getString();   //Get the request response payload
//      Serial.println(payload);                     //Print the response payload
//    }
//    else {
//      Serial.println("gagal");
////      Serial.println(http.errorToString(httpCode).c_str());
//    }
//    http.end();   //Close connection
//  }
//  delay(3000);
//}

void loop() {
//  if (Serial.available()) {
//    String a = Serial.readString();
//String a = String("/update?rataatas=")+random(1024)+"&ratabawah="+random(1024)+"&ratakanan="+random(1024)+"&ratakiri="+random(1024)+"&kd="+random(100)+"&tol="+random(50);
//     if (!client.connect(host, 80)) {
//    Serial.println("gagal konek");
//    return;
//  }
  if (Serial.available()) {
    String a = Serial.readString();
  }
  data = a;
//  data = Serial.readString();
  client.print(String("GET ") + data + " HTTP/1.1\n" + "Host: " + host + "\n" + "Connection: close\n\n");
//  Serial.print("data : "+String("GET ") + data + " HTTP/1.1 \n" + "Host: " + host + "\n" + "Connection: close\n\n");

  Serial.print(data);
  delay(1000);
  unsigned long timeout = millis();
  while (client.available() == 0) {
    if (millis()-timeout>3000) {
       Serial.println("client timeout");
      client.stop();
      return;
    }
  }
//}
}
