@echo off
ECHO test1 start

cd /d %~dp0
chdir
C:\xampp\php\php.exe test1.php

ECHO OK
PAUSE > NUL