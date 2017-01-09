benchmarks: install
	vendor/bin/athletic -p benchmarks

install: vendor/autoload.php

.PHONY: benchmarks install

vendor/autoload.php: composer.lock
	composer install

composer.lock: composer.json
	composer update
