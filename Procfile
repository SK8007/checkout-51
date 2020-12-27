release: php bin/console doctrine:migrations:migrate && echo "yes\n" | php bin/console doctrine:fixtures:load
web: heroku-php-apache2 public/
