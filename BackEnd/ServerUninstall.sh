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

echo "Uninstalling PHP..."
echo "**********************************************"
sudo bash $php_dir/RemovingPHP.sh
echo "Uninstalling MySQL done."
echo ""
echo ""

echo "Unstalling Apache2..."
echo "**********************************************"
sudo bash $apache_dir/RemoveFullApacheServer.sh
echo "Uninstalling Apache2 done."
echo ""
echo ""

echo "Unstalling MySQL..."
echo "**********************************************"
sudo bash $mysql_dir/RemoveMySQL.sh
echo "Uninstalling PHP done."
echo ""
echo ""

echo "Unstalling Transcription Program..."
echo "**********************************************"
sudo bash $transcription_dir/UninstallSphinx.sh
echo "Uninstalling Transcription Program done."
echo ""
echo ""

echo "Unstalling Summary Program..."
echo "**********************************************"
#sudo bash $summary_dir/
echo "Uninstalling Summary Program done. NONE AS OF YET"
echo ""
echo ""

sudo rm -r $programs_dir
sudo rm -r $working_space_dir
sudo rm -r $php_scripts_dir

sudo apt-get -y clean
sudo apt-get -y autoclean
sudo apt-get -y autoremove

echo "Uninstall Done! Sad to say bye!"
