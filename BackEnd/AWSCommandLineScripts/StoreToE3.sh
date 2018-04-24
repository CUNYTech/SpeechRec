#!/bin/bash

# specify the filename as the argument of this script.

BUCKET="speechrecaudios"
#DATASOURCEPATH="/home/ubuntu/working_space"
PATH1=$1
echo "Param is: $PATH1"

aws s3 cp $PATH1 s3://$BUCKET
