#include <stdlib.h>
#include <sys/types.h>
#include <unistd.h>
#include <stdio.h>

main ()
{
    setuid (0);
    char cmdLine[256];
    sprintf(cmdLine, "/usr/bin/nfc-list| egrep '(UID|PUPI)' | awk -F':' '{print $2}' | sed 's/ //g'");
    return system(cmdLine);
}