@echo off
call :setting
::=============================================================================================================================================================

Set keyword=26.20.100.7985
call :uninstall

Set keyword=10.26.0.9
call :uninstall

Set keyword=10.27.0.8
call :uninstall

Set keyword=11.1.0.15
call :uninstall

Set keyword=
call :uninstall

::=============================================================================================================================================================
::EX:
::Set UWPkeyword=RealtekAudioControl
::call :uninstallUWP

:UWP
Set UWPkeyword=
call :uninstallUWP

Set UWPkeyword=
call :uninstallUWP

Set UWPkeyword=
call :uninstallUWP

Set UWPkeyword=
call :uninstallUWP


::Please do not change below==================================================================================================================================
goto :end


:uninstall
if %keyword%NOkeyword==NOkeyword goto :skip_u

find /i "%keyword%" C:\Windows\INF\oem*.inf

if %errorlevel% GEQ 1 echo %date% %time% Driver keyword [%keyword%] cannot be found under C:\Windows\INF\oem*.inf on the unit. Skip
if %errorlevel% GEQ 1 goto :skip_u

echo %date% %time% Pnputil to uninstall driver related with [%keyword%] 

powershell -command "ls -r -path C:\windows\inf -filter oem*.inf | ?{$_ | select-string -pattern '%keyword%' -simplematch} | select -exp name | foreach($_) { pnputil /delete-driver $_ /force /uninstall }"

:skip_u
 
Set keyword=

exit /b



:uninstallUWP
if %UWPkeyword%NOkeyword==NOkeyword goto :skip_u_uwp


echo %date% %time% Uninstall UWPAPP related with [%UWPkeyword%] 

powershell -command "get-appxpackage *%UWPkeyword%* | remove-appxpackage -AllUsers"

:skip_u_uwp

Set UWPkeyword=

exit /b


:setting
title %~n0
cd /d "%~dp0"
exit /b

:end
timeout 3

