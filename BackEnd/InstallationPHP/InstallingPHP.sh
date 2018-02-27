#!/bin/bash

echo ""
echo "======================================================================"
echo "Installing PHP bash script initiated..."
echo "======================================================================"
echo ""

echo "----------------------------------------------------------------------"
echo "COMMAND: 'sudo apt-get install php libapache2-mod-php php-mcrypt php-mysql'"
echo "----------------------------------------------------------------------"
sudo apt-get install -y php libapache2-mod-php php-mcrypt php-mysql
echo "----------------------------------------------------------------------"
echo "COMMAND: 'sudo vim /etc/apache2/mods-enabled/dir.conf'"
echo "----------------------------------------------------------------------"
#In most cases, we'll want to modify the way that Apache serves files when a directory is requested. Currently, if a user requests a directory from the server, Apache will first look for a file called index.html. We want to tell our web server to prefer PHP files, so we'll make Apache look for an index.php file first.
#move the PHP index file to the first position after the DirectoryIndex specification
sudo vim /etc/apache2/mods-enabled/dir.conf
echo "----------------------------------------------------------------------"
echo "COMMAND: 'sudo systemctl restart apache2'"
echo "----------------------------------------------------------------------"
sudo systemctl restart apache2
echo "----------------------------------------------------------------------"
echo "COMMAND: 'sudo systemctl status apache2'"
echo "----------------------------------------------------------------------"
sudo systemctl status apache2
#echo "----------------------------------------------------------------------"
#echo "COMMAND: 'sudo apt-cache search php- | less' Take a look at the avaliable modules that can be installed."
#echo "----------------------------------------------------------------------"
#sudo apt-cache search php- | less
#echo "----------------------------------------------------------------------"
#echo "COMMAND: 'sudo apt-cache show [package_name]' Looks at the long descritption of the package."
#echo "----------------------------------------------------------------------"
#sudo apt-cache show [package_name]

echo "----------------------------------------------------------------------"
echo "Bash Script Completed!"
echo "----------------------------------------------------------------------"
