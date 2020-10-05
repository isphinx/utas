#!/bin/sh -x
# (Zhuoran Tang - 494544)
# introduction: copy files

echo $1 $2 $3
echo $#
# rm -fr dir3

# check the number of the parameters
if [ ! $# = 3 ]; then
	echo "parameter error"
	exit 1
fi

# check the first parameter
if [ ! -d $1 ]; then
	echo "$1 dirctory is not exist"
	exit 1
fi

# check the second parameter
if [ ! -d $2 ]; then
	echo "$2 dirctory is not exist"
	exit 1
fi

# check the third parameter
if [ -d $3 ]; then
	echo "$3 is already exist"
	exit 1
fi

# create the third directory
mkdir $3

# copy files from dir1 to dir3
echo "There files from dir1 copied into dir3:"
ls $1/
echo ""

for file in $1/*
do
	cp $file $3/
done

# dir2 files check and copy
echo "These new file(s) from dir2 copied into dir3:"
for path in $2/*
do 
	file=${path#*/}
	if [ ! -f $3/$file ]; then
		echo -ne "$file\t"
		cp $path $3/$file
	fi
done
echo ""
echo ""

echo "These file(s) from dir2 copied into dir3 and overwrite(s) existing older versions in dir3:"

for path in $2/*
do 
	file=${path#*/}
	if [ -f $1/$file ]; then
		if [ $path -nt $1/$file ]; then
			echo -ne "$file\t"
			cp $path $3/$file
		fi
	fi
done
echo ""
