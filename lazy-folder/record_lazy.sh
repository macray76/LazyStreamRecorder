#!/bin/bash
export PATH=$PATH:/usr/local/bin
SPORT=${1^^}
NOW=$(date -d "yesterday" +"%Y-%m-%d")

#Change the below two variables
#This is the location of your lazystream executable plus should be the same folder where this script is saved - DO NOT INCLUDE TRAILING /
LAZYLOC="/home/macray76/lazystream"
#This is the folder where you want your recording saved - DO NOT INCLUDE TRAILING /
MEDIALOC="/media/media3"


MEDIALOCFULL=$MEDIALOC/$1/$NOW

mkdir -p $MEDIALOCFULL

echo "Checking for $SPORT games on $NOW"

while IFS=';' read -r col1 col2 col3; do
	if [ $col3 == "1" ]
	then
		FOUNDGAME="0"
		#found a team I want to record so let's check for the game already recorded
		for f in $MEDIALOCFULL/*
		do
			if [[ $f =~ $col1 ]];
			then
				#game already recorded so skip it
				echo "$col1 already recorded. Skipping"
				FOUNDGAME="1"
				break
			fi
		done
		if [ $FOUNDGAME == "0" ]
		then
			#game not recorded so here we go
        	        echo "Recording $col1 game"
                	$LAZYLOC/lazystream record team $col2 --sport $1 --date $(date -d "yesterday" +"%Y%m%d") --quality 720p60 $MEDIALOCFULL/
		fi

	fi
done < $LAZYLOC/teams_$1.txt
