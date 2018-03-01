#!/bin/bash
echo "Uninstalling Sphinx..."

cd sphinxbase
sudo make uninstall
cd ..
cd pocketsphinx
sudo make uninstall
cd ..

sudo rm -r sphinxbase
sudo rm -r pocketsphinx

echo "Done!"
