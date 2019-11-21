#include <ESP8266WiFi.h>                                //Memuat library untuk menggunakan chip ESP, jika warnanya belum orange kamu perlu install librarynya
#include <WiFiClientSecure.h>                           //Memuat library untuk menggunakan WiFi dengan koneksi secure, jika warnanya belum orange kamu perlu install librarynya

#ifndef STASSID
#define STASSID "wifiku"                 //<-- Masukkan SSID WiFi kamu di sini
#define STAPSK  "12345678"             //<-- Masukkan Password WiFi kamu di sini
#endif

const char* ssid = STASSID;
const char* password = STAPSK;
const char* host = "choi.my.id/websolar";
const int httpsPort = 443;
WiFiClientSecure client;
String str;
void setup() {
  Serial.begin(115200);
  Serial.println();
  Serial.print("connecting to ");
  Serial.println(ssid);
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
}

void loop() {
  //Tahap 1; Pembacaan nilai dari tracker
if (Serial.available() > 0) {
String str = Serial.readString();
}
  //Tahap 2; Pengiriman data
  Serial.print("connecting to ");
  Serial.println(host);
  if (!client.connect(host, httpsPort)) {
    Serial.println("connection failed");
    return;
  }
  String url = str;
  Serial.print("requesting URL: ");
  Serial.println(url);
  client.print(String("GET ") + url + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" +
               "User-Agent: BuildFailureDetectorESP8266\r\n" +
               "Connection: close\r\n\r\n");
  Serial.println("request sent");
  while (client.connected()) {
    String line = client.readStringUntil('\n');
    if (line == "\r") {
      Serial.println("headers received");
      break;
    }
  }
  delay(100);
}
