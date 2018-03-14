#!/bin/bash

# install php
apt-get update && apt-get upgrade
sudo apt-get install php
php -v

# install php unit test framework
wget -O phpunit https://phar.phpunit.de/phpunit-7.phar
chmod +x phpunit
./phpunit --bootstrap getItems.php tests/getItemsTest.php

# to install Xdebug to get code coverage
# git clone https://github.com/xdebug/xdebug.git
# cd xdebug
# ./rebuild.sh

# run php unit test
phpunit --bootstrap getItems.php tests/getItemsTest.php --log-junit tests/xunit.xml

export PATH=/opt/IBM/node-v4.2/bin:$PATH
npm install -g npm@3.7.2 ### work around default npm 2.1.1 instability
npm install
npm install -g grunt-idra3

idra --publishtestresult --filelocation=./tests/xunit.xml --type=unittest
# idra --publishtestresult --filelocation=./tests/Cobertura.xml --type=code