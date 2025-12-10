PHP_VERSION ?= 8.1
USER = $$(id -u)

composer: ## composer install
	docker run --init -it --rm -u ${USER} -v "$$(pwd):/app" -w /app \
		composer:latest \
		composer install --optimize-autoloader --ignore-platform-reqs

composer-up: ## composer update
	docker run --init -it --rm -u ${USER} -v "$$(pwd):/app" -w /app \
		composer:latest \
		composer update --no-cache --ignore-platform-reqs

composer-dump: ## composer dump-autoload
	docker run --init -it --rm -u ${USER} -v "$$(pwd):/app" -w /app \
		composer:latest \
		composer dump-autoload

psalm: ## psalm
	docker run --init -it --rm -u ${USER} -v "$$(pwd):/app" -w /app \
		ghcr.io/kuaukutsu/php:${PHP_VERSION}-cli \
		./vendor/bin/psalm --php-version=${PHP_VERSION} --no-cache

phpstan: ## phpstan
	docker run --init -it --rm -u ${USER} -v "$$(pwd):/app" -w /app \
		ghcr.io/kuaukutsu/php:${PHP_VERSION}-cli \
		./vendor/bin/phpstan analyse -c phpstan.neon

rector: ## rector
	docker run --init -it --rm -u ${USER} -v "$$(pwd):/app" -w /app \
		ghcr.io/kuaukutsu/php:${PHP_VERSION}-cli \
		./vendor/bin/rector

bench: ##
	USER=$(USER) docker compose -f ./docker-compose.yml run --rm -u $(USER) -w / \
		-e XDEBUG_MODE=off \
		cli ./vendor/bin/phpbench run ./benchmark --report=aggregate --config=/benchmark/phpbench.json

app:
	USER=$(USER) docker compose -f ./docker-compose.yml run --rm -u $(USER) -w /src cli sh

two-pointers:
	USER=$(USER) docker compose -f ./docker-compose.yml run --rm -u $(USER) -w / \
    		-e XDEBUG_MODE=off \
    		cli php /src/TwoPointers/index.php

build:
	USER=$(USER) docker compose -f ./docker-compose.yml build cli

remove: _image_remove _container_remove

_image_remove:
	docker image rm -f \
		algo-cli

_container_remove:
	docker rm -f \
		algo_cli
