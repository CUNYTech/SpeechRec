#!/bin/bash

# specify the filename as the argument of this script.

BUCKET="speechrecaudios"
DATASOURCEPATH="/home/ubuntu/working_dir"
FILE1=$1
echo "Param is: $FILE1"

aws s3 cp "$DATASOURCEPATH/$FILE1" s3://$BUCKET
