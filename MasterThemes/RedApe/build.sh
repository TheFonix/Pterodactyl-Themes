#!/bin/sh

if [ ! -f "artisan" ]; then
    echo "File not found"
    else
    yum install git zip -y
    apt install git zip -y
    zip -r PterodactylBackup-$(date +"%Y-%m-%d").zip public resources
    mkdir -p tempdown && cd tempdown && git clone https://github.com/TheFonix/Pterodactyl-Themes.git .
    cp -r MasterThemes/RedApe/public ..
    cp -r MasterThemes/RedApe/resources ..
    cd .. && rm -rf tempdown
fi
