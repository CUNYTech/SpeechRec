#!/bin/bash

echo ""
echo "======================================================================"
echo "Uninstalling MySQL bash script initiated..."
echo "======================================================================"
echo ""

echo "----------------------------------------------------------------------"
echo "COMMAND: 'sudo vim /etc/apparmor.d/tunables/alias', comment out or remove 'alias /var/lib/mysql/ -> /home/yizong/CunyCODES/MySQL_data'"
echo "----------------------------------------------------------------------"
sudo vim /etc/apparmor.d/tunables/alias
echo "----------------------------------------------------------------------"
echo "COMMAND: 'sudo systemctl restart apparmor'"
echo "----------------------------------------------------------------------"
sudo systemctl restart apparmor
echo "----------------------------------------------------------------------"
echo "COMMAND: 'sudo apt-get remove -y mysql-*'" 
echo "----------------------------------------------------------------------"
sudo apt-get remove -y mysql-*
echo "----------------------------------------------------------------------"
echo "COMMAND: 'sudo apt-get purge -y mysql-*'"
echo "----------------------------------------------------------------------"
sudo apt-get purge -y mysql-*
#sudo dpkg --configure -a, to reset hung up things
echo "----------------------------------------------------------------------"

echo "----------------------------------------------------------------------"
echo "Bash Script Completed!"
echo "----------------------------------------------------------------------"
