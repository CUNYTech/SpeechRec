#!/bin/bash

echo ""
echo "======================================================================"
echo "Removing PHP bash script initiated..."
echo "======================================================================"
echo ""

echo "----------------------------------------------------------------------"
echo "COMMAND: 'sudo apt-get remove -y libapache2-mod-php php* '"
echo "----------------------------------------------------------------------"
sudo apt-get remove -y libapache2-mod-php php* 
echo "----------------------------------------------------------------------"
echo "COMMAND: 'sudo apt-get purge -y libapache2-mod-php php* '"
echo "----------------------------------------------------------------------"
sudo apt-get purge -y libapache2-mod-php php* 
echo "----------------------------------------------------------------------"
echo "COMMAND: 'sudo vim /etc/apache2/mods-enabled/dir.conf', please move the PHP index file to the first position after the index.pl."
echo "----------------------------------------------------------------------"
#move the PHP index file to the first position after the index.pl.
sudo vim /etc/apache2/mods-enabled/dir.conf

echo "----------------------------------------------------------------------"
echo "Bash Script Completed!"
echo "----------------------------------------------------------------------"
