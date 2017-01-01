<?php
// gcc getid.c -o getid
// chmod ug+s getid
$uidcard = trim(shell_exec(dirname(__DIR__).'/bin/getid'));