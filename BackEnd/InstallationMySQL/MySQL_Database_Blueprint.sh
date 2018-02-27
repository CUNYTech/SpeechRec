#!/bin/bash

script_dir="./Installing_Configure_MySQL"
mysql_user="root"
mysql_pass="3382400"

echo ""
echo "======================================================================"
echo "Setup Database Blueprint bash script initiated..."
echo "======================================================================"
echo ""

echo "----------------------------------------------------------------------"
echo "COMMAND: 'COMMAND: 'mysql -N -u $mysql_user -p *secret!* < $script_dir/MySQL_Database_Blueprint.batch'"
echo "----------------------------------------------------------------------"
mysql -N -u $mysql_user -p$mysql_pass < $script_dir/MySQL_Database_Blueprint.batch

echo "----------------------------------------------------------------------"
echo "Bash Script Completed!"
echo "----------------------------------------------------------------------"
