# LazyStreamRecorder
Web front-end for LazyStream to record your favourite teams for both NHL and MLB games.

This will record games from the previous day for those teams you have specified in the web page. If you have selected to record teams that are playing each other it will only record one version of the game.

Tested only on Linux (Ubuntu 18.04 LTS)

Web front-end written in php and script to execute LazyStream written using bash.


Instructions for use:
 - Copy contents of web-folder into your base web folder.
 - Edit lazy.ini file with your own specific folder locations.
 - Copy content of lazy-folder into the folder where you have the lazystream executable.
 - Edit record_lazy.sh folder and change the FILELOC and MEDIALOC variables at top of file.
 - Create a cronjob to execute the record_lazy.sh at the time you want passing the sport type variable: nhl or mlb
     e.g. 0 6 * * * /home/macray76/lazystream/record_lazy.sh "mlb"
     Above will execute the script at 6am every day
 - You may need to ensure the script is executable by running sudo chmod a+x record_lazy.sh



Thanks to the brilliant clfblackhawk and tarkah for their own creations.

This is a real hacky job - I'm not a coder and I'm sure there are a million better ways to achieve these results!
