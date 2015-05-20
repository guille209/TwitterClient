@echo off

if "%PHPBIN%" == "" set PHPBIN=D:\xampp2\php\php.exe
if not exist "%PHPBIN%" if "%PHP_PEAR_PHP_BIN%" neq "" goto USE_PEAR_PATH
GOTO RUN
:USE_PEAR_PATH
set PHPBIN=%PHP_PEAR_PHP_BIN%
:RUN
"%PHPBIN%" "C:\Users\Propietario\Google Drive\Master\13. PFM\Proyecto\vendor\doctrine\orm\bin\doctrine" %*