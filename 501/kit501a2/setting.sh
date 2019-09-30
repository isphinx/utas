#!/bin/sh 
# Xin Li(xli65 - 501186)
# introduction: editing config.txt

# function of dispaly the menu of options
displayMenu(){
	echo "*** MENU ***"
	echo "1. Add a Setting"
	echo "2. Delete a Setting"
	echo "3. View a Setting"
	echo "4. View All Settings"
	echo "Q – Quit"
}

if [ ! -f "config.txt" ]; then
	echo "the file config.txt is not exist!"
	exit 1
fi

# touch config.txt
# display menu and then let user to edit config.txt
while displayMenu && read -p "CHOICE:" -e -n 1 select
do
	echo 
	# add a setting to config.txt
	if [ "$select" = "1" ]; then
		while read -p "Enter setting (format: ABCD=abcd): " line; do
			if [ "$line" = "" ]; then
				echo -e "New setting not entered\n"
				continue
			elif [[ ! $line == *=* ]]; then
				echo -e "Invalid setting\n"
				continue
			fi
			name=${line%=*}
			value=${line#*=}
			echo "The variable name of the setting is: $name"
			echo "The variable value of the setting is: $value"

			if [ "$value" = "" -o "$name" = "" ]; then
				echo -e "Invalid setting\n"
				continue
			fi

			if [[ "$name" =~ (^[0-9].*) ]]; then
				echo -e "Invalid setting. The first character of a variable name cannot be a digit.\n"
				continue
			fi

			search=$(grep -E ^$name"=" config.txt)
			if [ ! "$search" = "" ]; then
				echo -e "Variable exists. Changing the values of existing variables is not allowed.\n"
				continue
			fi

			echo "$line">>config.txt
			echo -e "\nNew setting added.\n"
			break
		done
	# delete a setting to config.txt
	elif [ "$select" = "2" ]; then
		read -p "Enter setting: " line
		search=$(grep -E ^$line"=" config.txt)
		if [ "$search" = "" ]; then
			echo -e "Variable does not exist.\n"
		else
			echo $search
			read -p "Delete this setting (y/n)? " -n 1 line
			echo
			if [ "$line" = "y" ]; then
				echo -e "Setting deleted\n"
				sed -e "/"$search"/d" config.txt>config.txt.tmp
				mv config.txt.tmp config.txt
			fi
		fi
	# view a setting to config.txt
	elif [ "$select" = "3" ]; then
		read -p "Enter setting: " line
		search=$(grep -E ^$line"=" config.txt)
		if [ "$search" = "" ]; then
			echo -e "Variable does not exist.\n"
		else
			echo $search
			echo -e "Requested setting displayed above.\n"
		fi
	# display all settings to config.txt
	elif [ "$select" = "4" ]; then
		cat config.txt
		echo
	# quit application
	elif [ "$select" = "q" -o "$select" = "Q" ]; then
		break

	# invalid option
	else
		echo -e "Invalid choice.\n";
	fi
done
