#!/bin/sh

# Install brew (https://brew.sh/)
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"

# Install yarn (https://classic.yarnpkg.com/en/docs/install/#mac-stable)
brew install yarn

# Install composer (https://getcomposer.org/download/)
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
mv composer.phar /usr/local/bin/composer

# Install symfony (https://symfony.com/download)
curl -sS https://get.symfony.com/cli/installer | bash

# Install yarn packages
yarn install

# Install composer packages
composer install

# Start local database
docker-compose up -d

# Setup database
symfony console doctrine:migrations:migrate
symfony console doctrine:fixtures:load

# Start local web server
symfony serve
