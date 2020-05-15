@ECHO OFF
CLS

node -v 2>NUL
IF %ERRORLEVEL% GEQ 1  GOTO ERROR
IF %ERRORLEVEL% EQU 0 ECHO Node found...
ECHO Installing base modules
npm install 
ECHO Installing backend modules
npm --prefix ./backend install ./backend
ECHO Installing frontend modules
npm --prefix ./frontend install ./frontend
GOTO EOF

:ERROR
ECHO Node not found! Please, visit https://nodejs.org/en/download/ and install it first.

:EOF


