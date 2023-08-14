@echo off
call "%~dp0\o4w_env.bat"
if not exist "%OSGEO4W_ROOT%\apps\qgis\bin\qgisgrass8.dll" goto nograss
set savedpath=%PATH%
call "%OSGEO4W_ROOT%\apps\grass\grass82\etc\env.bat"
path %OSGEO4W_ROOT%\apps\grass\grass82\lib;%OSGEO4W_ROOT%\apps\grass\grass82\bin;%savedpath%
:nograss
@echo off
path %OSGEO4W_ROOT%\apps\qgis\bin;%PATH%
set QGIS_PREFIX_PATH=%OSGEO4W_ROOT:\=/%/apps/qgis
set GDAL_FILENAME_IS_UTF8=YES
rem Set VSI cache to be used as buffer, see #6448
set VSI_CACHE=TRUE
set VSI_CACHE_SIZE=1000000
set QT_PLUGIN_PATH=%OSGEO4W_ROOT%\apps\qgis\qtplugins;%OSGEO4W_ROOT%\apps\qt5\plugins
start "QGIS" /B "%OSGEO4W_ROOT%\bin\qgis-bin.exe" %*
