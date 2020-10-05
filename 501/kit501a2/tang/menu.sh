#!/bin/sh -x
# (Zhuoran Tang - 494544)
# introduction: editing records

ERR=$'\e[31m'
USER=$'\e[32m'
MENU=$'\e[33m'
INFO=$'\e[34m'
CLEAR=$'\e[0m'

# function of dispaly the menu of options
mainMenu() {
	echo "${MENU}Dominion Consulting Employees Info Main Menu"
   	echo "============================================"
   	echo "1 – Print All Current Records"
	echo "2 - Search for Specific Record(s)"
	echo "3 - Add New Records"
   	echo "4 – Delete Records"
   	echo "Q - Quit"
	echo "${CLEAR}"
}


# check if records exist
if [ ! -f "records" ]; then
	echo "the file records is not exist!"
	exit 1
fi

# read user selection
while mainMenu && read -p "${INFO}Your Selection: ${USER}" -e -n 1 select; do
	# print all records
	if [ "$select" = "1" ]; then
		echo "${CLEAR}"
		cat records

	# search records
	elif [ "$select" = "2" ]; then
		echo "${CLEAR}"
		read -p "${INFO}Enter keyword: ${USER}" line
		search=$(grep -E ":"$line":" records)
		if [ "$line" = "" ]; then
			echo "${ERR}Keyword not entered${CLEAR}"
		elif [ "$search" = "" ]; then
			echo "${USER}${line}${CLEAR} ${ERR}not found.${CLEAR}"
		else
			grep -E ":"$line":" records
			echo
		fi

	# add new records
	elif [ "$select" = "3" ]; then
		while true
	   	do
			echo "${CLEAR}${INFO}Add New Employee Record${CLEAR}\n"

			# read phone number
			while read -p "${INFO}Phone Number (xxxxxxxx): ${USER}" line; do
				echo ${CLEAR}
				search=$(grep -E ^$line":" records)
				if [ "$line" = "" ]; then
					echo "${ERR}Phone number not entered${CLEAR}"
					continue
				elif [ ! "$search" = "" ]; then
					echo "${ERR}Phone number exists${CLEAR}"
				elif [[ "$line" =~ (^[1-9][0-9]{7}$) ]]; then
					phonenumber=$line
					break
				else
					echo "${ERR}Invalid phone number${CLEAR}"
				fi
			done

			# read family name
			while read -p "${INFO}Family Name : ${USER}" line; do
				echo ${CLEAR}
				if [ "$line" = "" ]; then
					echo "${ERR}Family Name not entered${CLEAR}"
					continue
				elif [[ "$line" =~ (^[ a-zA-Z]*$) ]]; then
					familyname=$line
					break
				else
					echo "${ERR}Family name can contain only alphabetic characters and spaces${CLEAR}"
				fi
			done

			# read given name
			while read -p "${INFO}Given Name : ${USER}" line; do
				echo ${CLEAR}
				if [ "$line" = "" ]; then
					echo "${ERR}Given Name not entered${CLEAR}"
					continue
				elif [[ "$line" =~ (^[ a-zA-Z]*$) ]]; then
					givenname=$line
					break
				else
					echo "${ERR}Given name can contain only alphabetic characters and spaces${CLEAR}"
				fi
			done

			# read department number
			while read -p "${INFO}Department Number: ${USER}" line; do
				echo ${CLEAR}
				if [ "$line" = "" ]; then
					echo "${ERR}Department Number not entered${CLEAR}"
					continue
				elif [[ "$line" =~ (^[0-9][0-9]$) ]]; then
					department=$line
					break
				else
					echo "${ERR}Department Number contain two digits${CLEAR}"
				fi
			done

			# read job title
			while read -p "${INFO}Job Title: ${USER}" line; do
				echo ${CLEAR}
				if [ "$line" = "" ]; then
					echo "${ERR}Job Title not entered${CLEAR}"
					continue
				elif [[ "$line" =~ (^[ a-zA-Z]*$) ]]; then
					job=$line
					break
				else
					echo "${ERR}Job Title can contain only alphabetic characters and spaces${CLEAR}"
				fi
			done

			echo "${INFO}Adding new employee record to the records file ...${CLEAR}"
			echo "${INFO}New record saved${CLEAR}"
			echo
			echo "$phonenumber:$familyname:$givenname:$department:$job" >>records

			read -p "${INFO}Add another? (y)es or (n)o: ${USER}" -n 1 line
			echo ${CLEAR}
			case $line in
			Y | y) continue ;;
			*) break ;;
			esac
		done

	# del records
	elif [ "$select" = "4" ]; then
		echo "${INFO}Delete Employee Record${CLEAR}"

		# read phone number
		while read -p "${INFO}Enter a phone number: ${USER}" line; do
			echo ${CLEAR}
			search=$(grep -E ^$line":" records)
			if [[ ! "$line" =~ (^[1-9][0-9]{7}$) ]]; then
				echo "${ERR}Invalid phone number${CLEAR}"
			elif [ "$search" = "" ]; then
				echo "${ERR}Phone number not found.${CLEAR}"
			else
				echo "${INFO}$search${CLEAR}"
				echo

				# read delection confirm
				read -p "${INFO}Confirm deletion: (y)es or (n)o: ${USER}" -n 1 line
				echo
				case $line in
				Y | y)
					echo "${INFO}Record deleted.${CLEAR}"
					echo
					sed -e "/^"$search"/d" records >records.tmp
					mv records.tmp records
					break ;;
				*) break ;;
				esac
			fi
		done

	# quit
	elif [ "$select" = "Q" -o "$select" = "q" ]; then
		break
	else
		echo -e "${ERR}Invalid CHOICE${CLEAR}"

	fi

	echo "${INFO}Press Enter to continue...${CLEAR}"
	echo
   	read -p "$USER" -e -n 1 select
	if [ "$select" != "" ]; then
		break
	fi
done

