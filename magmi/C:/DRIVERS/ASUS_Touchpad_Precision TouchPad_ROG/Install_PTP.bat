pushd %~dp0
@echo off

reg query hklm\system\currentcontrolset\enum /s /f "Serial IO I2C" > "%~dp0serialio.ini"
find "Serial IO" "%~dp0serialio.ini" > nul
IF %errorlevel% EQU 1 GOTO SerialIOandTouchpad
IF %errorlevel% EQU 0 GOTO Touchpadonly

:SerialIOandTouchpad
echo installing Intel Serial IO driver......
pnputil.exe /add-driver .\SERIALIO\*.inf /install
echo installing Touchpad driver.....
pnputil -i -a .\PTP\x64\AsusPTPFilter.inf
GOTO END

:Touchpadonly
echo  Installing Touchpad driver.....
pnputil -i -a .\PTP\x64\AsusPTPFilter.inf
GOTO END


:END
reg add "HKEY_LOCAL_MACHINE\SOFTWARE\ASUS\Precision_Touchpad" /v DisplayVersion /t REG_SZ /d 11.0.0.32 /f
del "%~dp0serialio.ini"
del "%~dp0arc.ini"
