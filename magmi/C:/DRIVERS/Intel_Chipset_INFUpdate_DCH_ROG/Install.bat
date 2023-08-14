%~d0
cd %~dp0

pnputil /add-driver *.inf /subdirs /install
reg add "HKEY_LOCAL_MACHINE\SOFTWARE\ASUS\Chipset_Driver" /v DisplayVersion /t REG_SZ /d 10.1.31.2 /f
echo ReturnCode [%errorlevel%]
