#!/bin/bash

while true; do
    cd /home/php/ans || exit
    git pull
    sleep 30
done
