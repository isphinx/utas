#!/bin/sh 

if [ $# -eq 0 ]; then
	echo -e "This script removes C files which you no longer want to keep.\nHere are the C file(s) under the current directory:"
	files=$(ls *.c 2>/dev/null) 
	if [ "$files" = "" ]; then
		echo -e "No C files found.\n"
		exit 0
	fi
else
	echo -e "This script removes C files which you no longer want to keep.\nThe file(s) you want to delete is/are:"
	files=$@
fi

echo -e "$files\n"
for file in $files
do
	if [ -f $file ]; then
		echo -e "Displaying first 10 lines of $file:\n"
		head $file

		echo
		read -p "Delete file $file? (y/n):" -e -n 1 input
		if [ "$input" = "y" ]; then
			echo -e "File $file deleted.\n"
			rm $file
		else
			echo -e "File $file NOT deleted.\n"
		fi
	else
		echo -e "File $file is not exist.\n"
	fi
done
