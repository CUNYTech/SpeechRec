#!/bin/bash

# specify the filename as the argument of this script.

BUCKET="speechrecaudios"
#DATAENDPATH="/home/ubuntu/data_dir/"
FILE1=$1
PATH2=$2
echo "Param is: $FILE1"

aws s3 cp s3://$BUCKET/$FILE1 $PATH2
