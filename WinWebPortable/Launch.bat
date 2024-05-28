:: Start the apache24 server to host the pages
cd Apache24/bin
start httpd.exe
:: Start the sql server
cd ../mysql-8.4.0-winx64/bin
start "SQLServer" launchSQL.bat
cd ../../..
start RecipeFridge.url
pause
:: Close the two command lines running the server
taskkill /im httpd.exe
taskkill /FI "WindowTitle eq SQLServer - launchSQL.bat"