#!/bin/sh

displayMenu(){
	echo "*** MENU ***"
	echo "1. Add a Setting"
	echo "2. Delete a Setting"
	echo "3. View a Setting"
	echo "4. View All Settings"
	echo "Q – Quit"
}

touch config.txt

while displayMenu && read -p "CHOICE:" -e -n 1 select
do
	echo 
	if [ "$select" = "1" ]; then
		while read -p "Enter setting (format: ABCD=abcd): " line; do
			if [[ ! $line == *=* ]]; then
				echo "Invalid setting\n"
				continue
			fi
			name=${line%=*}
			value=${line#*=}
			echo "The variable name of the setting is: $name"
			echo "The variable value of the setting is: $value"

			if [ "$value" = "" -o "$name" = "" ]; then
				echo "Invalid setting.\n"
				continue
			fi

			if [[ "$name" =~ (^[0-9].*) ]]; then
				echo "Invalid setting. The first character of a variable name cannot be a digit.\n"
				continue
			fi

			search=$(grep -E ^$name"=" config.txt)
			if [ ! "$search" = "" ]; then
				echo "Variable exists. Changing the values of existing variables is not allowed.\n"
				continue
			fi

			echo "$line">>config.txt
			echo -e "\nNew setting added.\n"
			break
		done
	elif [ "$select" = "2" ]; then
		read -p "Enter setting: " line
		search=$(grep -E ^$line"=" config.txt)
		if [ "$search" = "" ]; then
			echo "Variable does not exist.\n"
		else
			echo $search
			read -p "Delete this setting (y/n)? " -n 1 line
			echo
			if [ "$line" = "y" ]; then
				echo "Setting deleted\n"
				sed -e "/"$search"/d" config.txt>config.txt1
				mv config.txt1 config.txt

			fi
		fi
	elif [ "$select" = "3" ]; then
		read -p "Enter setting: " line
		search=$(grep -E ^$line"=" config.txt)
		if [ "$search" = "" ]; then
			echo "Variable does not exist.\n"
		else
			echo $search
			echo "Requested setting displayed above.\n"
		fi
	elif [ "$select" = "4" ]; then
		cat config.txt
		echo
	elif [ "$select" = "q" -o "$select" = "Q" ]; then
		break
	else
		echo
	fi
done
