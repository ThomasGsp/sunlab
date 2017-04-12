#include <stdlib.h>
#include <sys/types.h>
#include <unistd.h>
#include <stdio.h>
#include <wiringPi.h>

const int butPin = 5;
const int door = 4;

int main(void)
{
    setuid (0);
    wiringPiSetup () ;
    pinMode(butPin, INPUT);
    pinMode (door, OUTPUT);
    while(1)
    {
        if (digitalRead(butPin)) // Button is released if this returns 1
        {


            digitalWrite (door, 1);
            delay (3000);
            if (! digitalRead(butPin)) // Button is released if this returns 1
            {
                digitalWrite (door, 0);
            }
        }
    }
    return 0 ;
}

