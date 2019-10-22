#!/bin/sh 
# Xin Li(xli65 - 501186)
# introduction: deletion of files
# Execution of the shell script

# Can handle invalid file names contained in user-supplied arguments list

# Without arguements
if [ $# -eq 0 ]; then
	echo -e "This script removes C files which you no longer want to keep.\nHere are the C file(s) under the current directory:"
	# Pick up each C file from current directory
	files=$(ls *.c 2>/dev/null) 
	if [ "$files" = "" ]; then
		echo -e "No C files found.\n"
		exit 0
	fi
# With arguements(a list of names of files)
else
	# Display a message then exit when there is no C file under current directory
	echo -e "This script removes C files which you no longer want to keep.\nThe file(s) you want to delete is/are:"
	files=$@
fi

echo -e "$files\n"

# delete file one by one
for file in $files
do
	echo -e "Displaying first 10 lines of $file:\n"
	if [ -f $file ]; then
		# List the first 10 lines then prompt for deletion
		head $file

		echo
		read -p "Delete file $file? (y/n):" -e -n 1 input
		case $input in
			Y|y)
				echo -e "File $file deleted.\n"
				rm $file # delete file
				;;
			*) echo -e "File $file NOT deleted.\n" ;;
		esac
	else
		echo -e "File $file is not exist.\n"
	fi
done
