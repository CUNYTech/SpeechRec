#!/bin/bash

# specify the filename as the argument of this script.

BUCKET="speechrecaudios"
FILE1=$1
echo "Param is: $FILE1"

aws s3 rm s3://$BUCKET/$FILE1
