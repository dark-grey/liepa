## Установка

1. `composer create-project`
2. прописать параметры доступа в бд в `.env`
3. `php artisan migrate`

## Использование

- Запуск парсинга командой:

`php artisan parse:rbc`

- вывод данных через api:

GET http://localhost/api/rbc-news

## Информация

- Логика парсинга в `app/Parsers/RbcNewsParser.php`
- Команда выполняется через `app/Console/Commands/ParseRbcNewsCommand.php`
- API контроллер `app/Http/Controllers/Api/RbcNewsController.php`
