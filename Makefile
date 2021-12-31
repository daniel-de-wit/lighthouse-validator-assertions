.PHONY: php-8.0
php-8.0:
	@docker-compose run --rm php-8.0 composer install
	@docker-compose run --rm php-8.0 sh

test-8.0:
	@docker-compose run --rm php-8.0 composer install
	@docker-compose run --rm php-8.0 composer run test

.PHONY: php-8.1
php-8.1:
	@docker-compose run --rm php-8.1 composer install
	@docker-compose run --rm php-8.1 sh

test-8.1:
	@docker-compose run --rm php-8.1 composer install
	@docker-compose run --rm php-8.1 composer run test

style-check:
	@docker-compose run --rm php-8.0 composer install
	@docker-compose run --rm php-8.0 composer run style-check

style-fix:
	@docker-compose run --rm php-8.0 composer install
	@docker-compose run --rm php-8.0 composer run style-fix

static-check:
	@docker-compose run --rm php-8.0 composer install
	@docker-compose run --rm php-8.0 composer run static-check

coverage:
	@docker-compose run --rm php-8.1 composer install
	@docker-compose run --rm php-8.1 composer run coverage

coveralls:
	@make coverage
	@docker-compose run --rm php-8.1 -e COVERALLS_REPO_TOKEN=$COVERALLS_REPO_TOKEN composer run coveralls
