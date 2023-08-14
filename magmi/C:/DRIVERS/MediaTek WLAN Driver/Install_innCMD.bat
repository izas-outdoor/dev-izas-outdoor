@echo off
pushd %~dp0%
Install.cmd
echo ERRORLEVEL %ERRORLEVEL%
