echo chaine 1
(
------------------------------------
 
      1: Installation de Chocolatey
      2: Installation OSquery
      2: Installation cURL
      3: Mise en place du Script d'analyse

-------------------------------------
) 2>nul

@"%SystemRoot%\System32\WindowsPowerShell\v1.0\powershell.exe" -NoProfile -ExecutionPolicy Bypass -Command "iex ((New-Object System.Net.WebClient).DownloadString('https://chocolatey.org/install.ps1'))" && SET "PATH=%PATH%;%ALLUSERSPROFILE%\chocolatey\bin"
if %errorlevel% == 0 goto NEXTosquery
echo "Erreur durant l'installation de Chocolatey. Status de l'erreur: %errorlevel%"
goto endofscript


:NEXTosquery
choco install osquery -y 
if %errorlevel% == 0 goto NEXTcurl
echo "Erreur durant l'installation de OSquery. Status de l'erreur: %errorlevel%"
goto endofscript


:NEXTcurl
choco install curl -y 
if %errorlevel% == 0 goto NEXTanalyse
echo "Erreur durant l'installation de cURL. Status de l'erreur: %errorlevel%"
goto endofscript

:NEXTanalyse
cd %userprofile%\AppData\Roaming\Microsoft\Windows\Start Menu\Programs\Startup
> AnalyseOSquery.bat (
  set /p"=osqueryi --json "select * from os_version" >reponse.json "<nul
  echo.
  set /p"=curl -H "Content-Type: application/json" -X POST -d "@reponse.json" http://localhost:82/site-reception/main.php"<nul
  echo.
  set /p"=echo o|del reponse.json"<nul
)
goto endofscript


:endofscript 
pause Fini !