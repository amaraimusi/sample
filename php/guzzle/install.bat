@echo off
ECHO Composerを実行してライブラリをインストールします。
ECHO 終了まで1分くらいお待ちください。

cd C:\xampp\htdocs\sample\php\guzzle
SET phpdir=C:\xampp\php\
%phpdir%php.exe composer.phar install

ECHO 終了しました。
PAUSE > NUL