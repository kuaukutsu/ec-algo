PHP_VERSION ?= 8.1
USER = $$(id -u)

# https://marmelab.com/blog/2016/02/29/auto-documented-makefile.html
.PHONY: help
.DEFAULT_GOAL := help

help: ## Display this help screen
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n  make \033[36m<target>\033[0m\n"} /^[a-zA-Z_-]+:.*?##/ { printf "  \033[36m%-15s\033[0m %s\n", $$1, $$2 } /^##@/ { printf "\n\033[1m%s\033[0m\n", substr($$0, 5) } ' $(MAKEFILE_LIST)


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

phpstan: ## phpstan
	docker run --init -it --rm -u ${USER} -v "$$(pwd):/app" -w /app \
		ghcr.io/kuaukutsu/php:${PHP_VERSION}-cli \
		./vendor/bin/phpstan analyse -c phpstan.neon

rector: ## rector
	docker run --init -it --rm -u ${USER} -v "$$(pwd):/app" -w /app \
		ghcr.io/kuaukutsu/php:${PHP_VERSION}-cli \
		./vendor/bin/rector

bench: ## phpbench all groups
	USER=$(USER) docker compose -f ./docker-compose.yml run --rm -u $(USER) -w / \
		-e XDEBUG_MODE=off \
		cli ./vendor/bin/phpbench run ./benchmark --report=aggregate --config=/benchmark/phpbench.json

bench-two-pointers: ## phpbench two-pointers group
	USER=$(USER) docker compose -f ./docker-compose.yml run --rm -u $(USER) -w / \
		-e XDEBUG_MODE=off \
		cli ./vendor/bin/phpbench run ./benchmark \
		--group=two-pointers --report=aggregate --config=/benchmark/phpbench.json

bench-linked-list: ## phpbench two-pointers group
	USER=$(USER) docker compose -f ./docker-compose.yml run --rm -u $(USER) -w / \
		-e XDEBUG_MODE=off \
		cli ./vendor/bin/phpbench run ./benchmark \
		--group=linked-list --report=aggregate --config=/benchmark/phpbench.json

run-two-pointers: ## run script "two pointers"
	USER=$(USER) docker compose -f ./docker-compose.yml run --rm -u $(USER) -w / \
    		-e XDEBUG_MODE=off \
    		cli php /src/TwoPointers/index.php

run-linked-list: ## run script "linked list"
	USER=$(USER) docker compose -f ./docker-compose.yml run --rm -u $(USER) -w / \
    		-e XDEBUG_MODE=off \
    		cli php /src/LinkedList/index.php

run-sliding-window: ## run script "sliding window"
	USER=$(USER) docker compose -f ./docker-compose.yml run --rm -u $(USER) -w / \
    		-e XDEBUG_MODE=off \
    		cli php /src/SlidingWindow/index.php

app:
	USER=$(USER) docker compose -f ./docker-compose.yml run --rm -u $(USER) -w /src cli sh

build:
	USER=$(USER) docker compose -f ./docker-compose.yml build cli

remove: _image_remove _container_remove

_image_remove:
	docker image rm -f \
		algo-cli

_container_remove:
	docker rm -f \
		algo_cli
