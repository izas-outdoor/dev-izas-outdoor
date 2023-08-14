pnputil.exe /add-driver iigd_dch.inf /install
pnputil.exe /add-driver ".\extention_inf\iigd_ext.inf" /install
echo setup ReturnCode[%errorlevel%]