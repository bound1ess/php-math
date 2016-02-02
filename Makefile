test: ; vendor/bin/phpunit --testdox
cover: ; vendor/bin/phpunit --coverage-html coverage
server: ; php -S localhost:8080 -t coverage
