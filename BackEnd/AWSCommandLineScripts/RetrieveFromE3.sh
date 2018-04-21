#!/bin/bash

# specify the filename as the argument of this script.

BUCKET="speechrecaudios"
DATASOURCEPATH="/home/ubuntu/data_dir"
FILE1=$1
echo "Param is: $FILE1"

aws s3 cp s3://"$BUCKET/$FILE1" "$DATASOURCEPATH/$FILE1"
