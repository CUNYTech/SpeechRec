#!/bin/bash

echo "Installing pre-req."
sudo apt-get install git
sudo apt-get install automake
sudo apt-get install libtool
sudo apt-get install bison
sudo apt-get install python-dev
sudo apt-get install swig
sudo apt-get install make
sudo apt-get install pkg-config
echo "Pre-req done..."

echo "Git cloning Spinx."
git clone https://github.com/cmusphinx/sphinxbase.git
echo "Git done..."

echo "And the rest... lol"
cd sphinxbase
./autogen.sh
make
sudo make install
cd ..
echo "Git cloning PocketSpinx."
git clone git://github.com/cmusphinx/pocketsphinx.git
echo "Git done..."
cd pocketsphinx
./autogen.sh
make
sudo make install
cd ..
echo "rest are all done..."
