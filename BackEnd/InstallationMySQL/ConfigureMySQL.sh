#!/bin/bash

echo ""
echo "======================================================================"
echo "Configuring MySQL bash script initiated..."
echo "======================================================================"
echo ""

source_dir="./"
data_dir="./mysql"

#echo "----------------------------------------------------------------------"
#echo "COMMAND: 'mysqld --initialize'"
#echo "----------------------------------------------------------------------"
#mysqld --initialize
#echo "----------------------------------------------------------------------"
#echo "COMMAND: 'mkdir MySQL_data'"
#echo "----------------------------------------------------------------------"
#mkdir MySQL_data
echo "----------------------------------------------------------------------"
echo "COMMAND: 'mysql -u  root -p', type in 'select @@datadir;' to verify current data dir."
echo "----------------------------------------------------------------------"
mysql -u  root -p
echo "----------------------------------------------------------------------"
#quit the mysql admin thing to continue
echo "COMMAND: 'sudo systemctl stop mysql'"
echo "----------------------------------------------------------------------"
sudo systemctl stop mysql
echo "----------------------------------------------------------------------"
echo "COMMAND: 'sudo systemctl status mysql'"
echo "----------------------------------------------------------------------"
sudo systemctl status mysql
echo "----------------------------------------------------------------------"
#make sure it's actually shutdown by see if there's 'Stopped MySQL Community Server'.
#DATADIR is the path where you will have your new place to store your database. Make sure there's no trailing '/', When there’s a trailing slash, rsync will dump the contents of the directory into the mount point instead of transferring it into a containing mysql directory.
echo "COMMAND: 'sudo rsync -av /var/lib/mysql $source_dir', only copies content and permission to new location."
echo "----------------------------------------------------------------------"
sudo rsync -av /var/lib/mysql $source_dir
echo "----------------------------------------------------------------------"
#making a temp backup of /var/lib/mysql
#echo "----------------------------------------------------------------------"
#echo "COMMAND: 'sudo mv /var/lib/mysql /var/lib/mysql.bak'"
#echo "----------------------------------------------------------------------"
#sudo mv /var/lib/mysql /var/lib/mysql.bak
echo "COMMAND: 'sudo rm -r /var/lib/mysql'"
echo "----------------------------------------------------------------------"
sudo rm -r /var/lib/mysql
echo "----------------------------------------------------------------------"
#edit the file so mysql will now know your new data directory.
echo "COMMAND: 'sudo vim /etc/mysql/mysql.conf.d/mysqld.cnf', change datadir= $data_dir"
echo "----------------------------------------------------------------------"
sudo vim /etc/mysql/mysql.conf.d/mysqld.cnf
echo "----------------------------------------------------------------------"
#edit apparmor to let MySQL writ to new directory by creating alias between default directory and the new location.
echo "COMMAND: 'sudo vim /etc/apparmor.d/tunables/alias', add 'alias /var/lib/mysql/ -> $data_dir,' at the bottom of the file."
echo "----------------------------------------------------------------------"
sudo vim /etc/apparmor.d/tunables/alias
echo "----------------------------------------------------------------------"
echo "COMMAND: 'sudo systemctl restart apparmor'"
echo "----------------------------------------------------------------------"
sudo systemctl restart apparmor
echo "----------------------------------------------------------------------"
#The next step is to start MySQL, the script mysql-systemd-start checks for the existence of either a directory, -d, or a symbolic link, -L, that matches two default paths. It fails if they're not found. Since we need these to start the server, we will create the minimal directory structure to pass the script's environment check.
echo "COMMAND: 'sudo mkdir /var/lib/mysql/mysql -p'"
echo "----------------------------------------------------------------------"
sudo mkdir /var/lib/mysql/mysql -p
echo "----------------------------------------------------------------------"
echo "COMMAND: 'sudo systemctl start mysql'"
echo "----------------------------------------------------------------------"
sudo systemctl start mysql
echo "----------------------------------------------------------------------"
echo "COMMAND: 'sudo systemctl status mysql'"
echo "----------------------------------------------------------------------"
sudo systemctl status mysql
echo "----------------------------------------------------------------------"
echo "COMMAND: 'mysql -u root -p',  to verify that now the new data dir is indeed $data_dir , type in 'select @@datadir;'"
echo "----------------------------------------------------------------------"
mysql -u root -p
#At this point, it's assumed everything worked out fine, and that I can delete the backed up files.
#echo "COMMAND: 'sudo rm -Rf /var/lib/mysql.bak'"
#echo "----------------------------------------------------------------------"
#sudo rm -Rf /var/lib/mysql.bak
echo "----------------------------------------------------------------------"
echo "COMMAND: 'sudo systemctl restart mysql'"
echo "----------------------------------------------------------------------"
sudo systemctl restart mysql
echo "----------------------------------------------------------------------"
echo "COMMAND: 'sudo systemctl status mysql'"
echo "----------------------------------------------------------------------"
sudo systemctl status mysql

echo "----------------------------------------------------------------------"
echo "Bash Script Completed!"
echo "----------------------------------------------------------------------"
