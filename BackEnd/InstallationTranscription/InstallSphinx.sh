#!/bin/bash

echo "Installing pre-req."
sudo apt-get -y install git
sudo apt-get -y install automake
sudo apt-get -y install libtool
sudo apt-get -y install bison
sudo apt-get -y install python-dev
sudo apt-get -y install swig
sudo apt-get -y install make
sudo apt-get -y install pkg-config
echo "Pre-req done..."

echo "Git cloning Spinx."
git clone https://github.com/cmusphinx/sphinxbase.git
echo "Git done..."

echo "And the rest... lol"
cd sphinxbase
./autogen.sh
make
yes | sudo make install
cd ..
echo "Git cloning PocketSpinx."
git clone git://github.com/cmusphinx/pocketsphinx.git
echo "Git done..."
cd pocketsphinx
./autogen.sh
make
yes | sudo make install
cd ..
echo "rest are all done..."
