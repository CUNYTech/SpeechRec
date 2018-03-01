#!/bin/bash
echo "Uninstalling Sphinx..."

cd sphinxbase
yes | sudo make uninstall
cd ..
cd pocketsphinx
yes | sudo make uninstall
cd ..

yes | sudo rm -r sphinxbase
yes | sudo rm -r pocketsphinx

echo "Done!"
