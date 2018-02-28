#!/bin/bash

echo ""
echo "======================================================================"
echo "Testing PHP bash script initiated..."
echo "======================================================================"
echo ""

echo "----------------------------------------------------------------------"
echo "Creating /var/www/html/info.php"
echo "----------------------------------------------------------------------"
sudo bash -c "echo '<?php' >> /var/www/html/info.php"
sudo bash -c "echo 'phpinfo()' >> /var/www/html/info.php"
sudo bash -c "echo '?>' >> /var/www/html/info.php"
echo "----------------------------------------------------------------------"
echo "Getting local variable to be assigned our public IP."
echo "----------------------------------------------------------------------"
public_ip=$(sudo hostname -I)
echo "----------------------------------------------------------------------"
echo "Try this address on your web browser: http://$public_ip/info.php"
echo "----------------------------------------------------------------------"
read -n 1 -s -r -p "Press any key to continue, after you have tested the IP address on a web browser."
echo ""
echo "----------------------------------------------------------------------"
echo "COMMAND: 'sudo rm /var/www/html/info.php'"
echo "----------------------------------------------------------------------"
#Remove this file after this test because it could actually give information about your server to unauthorized users.
sudo rm /var/www/html/info.php

echo "----------------------------------------------------------------------"
echo "Bash Script Completed!"
echo "----------------------------------------------------------------------"
