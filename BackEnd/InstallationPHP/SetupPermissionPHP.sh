#1/bin/bash

echo "Starting permission setting for PHP now."

chown -R www-data:ubuntu /home/ubuntu/working_space/
chmod -R 755 /home/ubuntu/working_space/

chown -R www-data:ubuntu /home/ubuntu/data_dir/
chmod -R 755 /home/ubuntu/data_dir

echo "Finished permission setting for PHP..."
