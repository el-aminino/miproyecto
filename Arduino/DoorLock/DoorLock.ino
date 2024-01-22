
// --------------------------------------------------------------- Wiring ------------------------------------------------------
// --------------------------------------------------------------  RFID SDA  >> Arduino  5  ------------------------------------
// --------------------------------------------------------------  RFID SCK  >> Arduino  13 ------------------------------------
// --------------------------------------------------------------  RFID MOSI >> Arduino  11 ------------------------------------
// --------------------------------------------------------------  RFID MISO >> Arduino  12 ------------------------------------
// --------------------------------------------------------------  RFID RQ   >> Arduino  no connection -------------------------
// --------------------------------------------------------------  RFID GND  >> Arduino  GND -----------------------------------
// --------------------------------------------------------------  RFID RST  >> Arduino  9 -------------------------------------
// --------------------------------------------------------------  RFID 3.3V >> Arduino  +3.3V ---------------------------------


// --------------------------------------------------------------  Relay GND  >> Arduino  GND -----------------------------------
// --------------------------------------------------------------  Relay VCC  >> Arduino  5V ------------------------------------
// --------------------------------------------------------------  Relay IN-1 >> Arduino  3 -------------------------------------


// --------------------------------------------------------------  Buzzer +  >> Arduino  2 --------------------------------------
// --------------------------------------------------------------  Buzzer -  >> Arduino  GND ------------------------------------

#include <SPI.h>
#include <MFRC522.h>
#include <avr/wdt.h>
#define SS_PIN 5
#define RST_PIN 9
#define RELAY 3 //connect the relay to number 3 pin
#define BUZZER 2 // connect the buzzer to 2 pin
#define ACCESS_DELAY 2000
#define DENIED_DELAY 1000
MFRC522 mfrc522(SS_PIN, RST_PIN);   // Create MFRC522 instance.
void setup() 
{
  Serial.begin(9600);   // Initiate a serial communication
  SPI.begin();          // Initiate  SPI bus
  mfrc522.PCD_Init();   // Initiate MFRC522
  pinMode(RELAY, OUTPUT);
  pinMode(BUZZER, OUTPUT);   
  noTone(BUZZER);
  digitalWrite(RELAY, HIGH);
  //Serial.println("Put your card to the reader for scanning ...");
  Serial.println();

}
void loop() 
{
  // Look for new cards
  if ( ! mfrc522.PICC_IsNewCardPresent()) 
  {
    return;
  }
  // Select one of the cards
  if ( ! mfrc522.PICC_ReadCardSerial()) 
  {
    return;
  }
  //Show UID on serial monitor
  //Serial.print("UID tag :");
  String content= "";
  byte letter;
  for (byte i = 0; i < mfrc522.uid.size; i++) 
  {
     Serial.print(mfrc522.uid.uidByte[i] < 0x10 ? "0" : "");
     Serial.print(mfrc522.uid.uidByte[i], HEX);
     content.concat(String(mfrc522.uid.uidByte[i] < 0x10 ? "0" : ""));
     content.concat(String(mfrc522.uid.uidByte[i], HEX));
  }
  Serial.println();
  wdt_enable(WDTO_2S);
  delay(500);
  wdt_reset();
  wdt_disable();
  /*Serial.print("Message : ");
  content.toUpperCase();
  
  Serial.println("Authorized access");
  Serial.println();
  
  digitalWrite(RELAY, LOW);
  delay(ACCESS_DELAY);
  digitalWrite(RELAY, HIGH);
  */
}
