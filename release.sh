#!/bin/bash


# PLEASE USE GIT DEPLOYMEN (README.md)


# Creates a release package
DIR="./_release"
mkdir -p "$DIR"

# Update Version
perl -pe '/^Version: / and s/(\d+\.\d+\.\d+\.)(\d+)/$1 . ($2+1)/e' -i style.css

#Sync files
rsync -va ./acf-json/ ./_release/acf-json/
rsync -va ./components/ ./_release/components/
rsync -va ./src/ ./_release/src/
rsync -va ./languages/ ./_release/languages/
rsync -va ./dist/ ./_release/dist/
rsync -va ./templates/ ./_release/templates/
cp -v ./functions.php ./_release/
cp -v ./bud.config.mjs ./_release/
cp -v ./package.json ./_release/
cp -v ./package-lock.json ./_release/
cp -v ./yarn.lock ./_release/
cp -v ./index.php ./_release/
cp -v ./screenshot.png ./_release/
cp -v ./style.css ./_release/

# Delete hidden files
find ./_release/ -name '.DS*' -delete

# Copy files to LIVE server
#rsync -rva ./_release/ nflxz@neofluxe.com:/home/nflxz/www/neofluxe.com/content/themes/neofluxe/

rm -rf "$DIR"

echo "Done";