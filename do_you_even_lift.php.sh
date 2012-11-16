#!/bin/bash

while [ 1 ]
do
    php -c php.ini do_you_even_lift.php "https://176.31.234.186"
    php -c php.ini do_you_even_lift.php "https://godbox.biz"
    sleep 1
done
