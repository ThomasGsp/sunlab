#include <stdlib.h>
#include <sys/types.h>
#include <unistd.h>
#include <stdio.h>
#include <wiringPi.h>


const int door = 4;
int main(void)
{
    setuid (0);

    wiringPiSetup () ;
    pinMode (door, OUTPUT) ;
    digitalWrite (door, 1) ;
    delay (3000) ;
    digitalWrite (door, 0) ;
    return 0 ;
}

