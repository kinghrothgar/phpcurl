#!/bin/bash

while [ 1 ]
do
    php -c php.ini do_you_even_lift.php "https://ec2-46-51-132-183.eu-west-1.compute.amazonaws.com"
    php -c php.ini do_you_even_lift.php "https://46.51.132.183"
    sleep 1
done
