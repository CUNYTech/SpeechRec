#!/bin/bash

mysql_dir="./InstallationMySQL"
apche_dir="./InstallationApache"
php_dir="./InstallationPHP"
transcription_dir="./InstallationTranscription"
summary_dir="./InstallationSummary"

programs_dir="./API"
data_dir="./data_dir"
working_space_dir="./working_space"
php_scripts_dir="./PHP_scripts"

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
cd $programs_dir
sudo bash $transcription_dir/InstallSphinx.sh
cd ..
echo "Installing Transcription Program done."
echo ""
echo ""

echo "Installing Summary Program..."
echo "**********************************************"
cd $programs_dir
#sudo bash $summary_dir/
cd ..
echo "Installing Summary Program done. NONE AS OF YET"
echo ""
echo ""

echo "Setup Done! Enjoy!"
