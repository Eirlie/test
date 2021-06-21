# Запуск приложения без пересоздания данных
start:
	@docker compose up -d
	@docker compose exec app composer install --no-progress --no-interaction
	@docker compose exec app bin/console doctrine:migrations:migrate --no-interaction