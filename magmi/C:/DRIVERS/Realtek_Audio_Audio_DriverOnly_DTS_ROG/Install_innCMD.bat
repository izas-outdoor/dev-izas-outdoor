@echo off
pushd %~dp0%
InstallPackage.bat
echo ERRORLEVEL %ERRORLEVEL%
