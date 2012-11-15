#!/bin/bash

while [ 1 ]
do
    stderr=$(curl --connect-timeout 2 -k https://godbox.biz 2>&1 1>/dev/null )
    if [ "$?" != "0" ] ; then
        echo "[$(date)] $stderr" > curl_error.log
    fi
    sleep 1
done
