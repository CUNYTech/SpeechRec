#!/bin/bash

mysql_dir="./InstallationMySQL"
apche_dir="./InstallationApache"
php_dir="./InstallationPHP"

echo "Installing MySQL..."
echo "**********************************************"
sudo bash $mysql_dir/InstallMySQL.sh
sudo bash $mysql_dir/ConfigureMySQL.sh
sudo bash $mysql_dir/MySQL_Database_Blueprint.sh
echo ""
echo ""

echo "Installing Apache2..."
echo "**********************************************"
sudo bash $apache_dir/InstallApacheServer.sh
echo ""
echo ""

echo "Installing PHP..."
echo "**********************************************"
sudo bash $php_dir/InstallingPHP.sh
sudo bash $php_dir/TestingPHP.sh
echo ""
echo ""

echo "Setup Done! Enjoy!"
