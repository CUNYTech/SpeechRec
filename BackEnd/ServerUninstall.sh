#!/bin/bash

mysql_dir="./InstallationMySQL"
apche_dir="./InstallationApache"
php_dir="./InstallationPHP"

echo "Uninstalling PHP..."
echo "**********************************************"
sudo bash $php_dir/RemovingPHP.sh
echo ""
echo ""

echo "Unstalling Apache2..."
echo "**********************************************"
sudo bash $apache_dir/RemoveFullApacheServer.sh
echo ""
echo ""

echo "Unstalling MySQL..."
echo "**********************************************"
sudo bash $mysql_dir/RemoveMySQL.sh
echo ""
echo ""

sudo apt-get -y clean
sudo apt-get -y autoclean
sudo apt-get -y autoremove

echo "Uninstall Done! Sad to say bye!"
