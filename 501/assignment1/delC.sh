#!/bin/sh 
echo "This script removes C files which you no longer want to keep.\nHere are the C file(s) under the current directory:"

if [ $# -eq 0 ]; then
	files=$(ls *.c 2>/dev/null) 
	if [ "$files" = "" ]; then
		echo "No C files found.\n"
		exit 0
	fi
else
	files=$@
fi

echo "$files\n"
for file in $files
do
	if [ -f $file ]; then
		echo "Displaying first 10 lines of $file:\n"
		head $file

		echo
		read -p "Delete file $file? (y/n):" -e -n 1 input
		if [ "$input" = "y" ]; then
			echo "File $file deleted.\n"
			rm $file
		else
			echo "File $file NOT deleted.\n"
		fi
	else
		echo "File $file is not exist.\n"
	fi
done
