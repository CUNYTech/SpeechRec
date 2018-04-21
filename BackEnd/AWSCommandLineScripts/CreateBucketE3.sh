#!/bin/bash

BUCKETNAME1=$1
echo "Param is: $BUCKETNAME1"
#must do aws configure, keep default key and pass, change the region to the correct region, our case us-east-2. And default output to .json
aws s3 mb s3://$BUCKETNAME1
#our official bucket is s3://speechrecaudios