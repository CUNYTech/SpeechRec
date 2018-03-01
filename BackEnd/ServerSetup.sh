#!/bin/bash

mysql_dir="./InstallationMySQL"
apche_dir="./InstallationApache"
php_dir="./InstallationPHP"
transcription_dir="./InstallationTranscription"
summary_dir="./InstallationSummary"

echo "Installing MySQL..."
echo "**********************************************"
sudo bash $mysql_dir/InstallMySQL.sh
sudo bash $mysql_dir/ConfigureMySQL.sh
sudo bash $mysql_dir/MySQL_Database_Blueprint.sh
echo "Installing MySQL done."
echo ""
echo ""

echo "Installing Apache2..."
echo "**********************************************"
sudo bash $apache_dir/InstallApacheServer.sh
echo "Installing Apache2 done."
echo ""
echo ""

echo "Installing PHP..."
echo "**********************************************"
sudo bash $php_dir/InstallingPHP.sh
sudo bash $php_dir/TestingPHP.sh
echo "Installing PHP done."
echo ""
echo ""

echo "Installing Transcription Program..."
echo "**********************************************"
sudo bash $transcription_dir/InstallSphinx.sh
echo "Installing Transcription Program done."
echo ""
echo ""

echo "Installing Summary Program..."
echo "**********************************************"
#sudo bash $summary_dir/
echo "Installing Summary Program done. NONE AS OF YET"
echo ""
echo ""

echo "Setup Done! Enjoy!"
