# Repo base amb tests per a l'exercici de PHP+MySQL

Aquest és un repo base amb els tests per a l'exerici 1 disponible a la site:

    https://bytes.cat/php_mysql#exercici_1

## Installation

You need to have installed:
  * PHP >= 7.4
  * Extra PHP packages: php-zip, php-curl, php-dom, php-mbstring
  * composer: https://getcomposer.org/download/
  * geckodriver: https://github.com/mozilla/geckodriver/releases

References:
  * Selenium PHP Driver: https://github.com/php-webdriver/php-webdriver
  * Example: https://github.com/php-webdriver/php-webdriver/blob/main/example.php
  * Doc: https://github.com/php-webdriver/php-webdriver/wiki/Example-command-reference
  * PHPunit + selenium: https://jakobbr.eu/2020/10/24/adventures-with-phpunit-geckodriver-and-selenium/


## General procedure

Install dependencies:

    $ sudo apt install php-curl php-mbstring php-xml

Install composer from here: https://getcomposer.org/download/

Clone repo and download packages:

    $ composer install

### Shell 1: web server
Start webapp in port 8000 in an independent shell:

    $ cd src
    $ php -S 0.0.0.0:8000

### Shell 2: execute tests
Run all tests in ``.tests`` folder (done with phpunit):

    $ vendor/bin/phpunit .tests

You could also run tests one by one:

    $ vendor/bin/phpunit .tests/TitleTest.php

## Troubleshooting

If the test errors do not appear, open your php.ini file (usually ``/etc/php/X.Y/cli/php.ini``) and check the variable ``zend.assertions = 1``.

