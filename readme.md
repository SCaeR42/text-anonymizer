# Text Anonymizer

PHP-библиотека для маскирования чувствительных данных в тексте: email, телефонов и банковских карт.

## Возможности

- [`Anonymizer::maskEmail()`](src/Anonymizer.php:10) — маскирует email, оставляя домен и крайние символы локальной части.
- [`Anonymizer::maskPhone()`](src/Anonymizer.php:35) — маскирует телефон, оставляя последние 4 цифры.
- [`Anonymizer::maskCard()`](src/Anonymizer.php:53) — маскирует номер карты, оставляя последние 4 цифры.
- [`Anonymizer::maskAll()`](src/Anonymizer.php:71) — маскирует email, телефоны и карты внутри произвольного текста.

## Требования

- PHP >= 7.4
- Composer

## Установка

```bash
composer require scody/text-anonymizer
```

Для локальной разработки установите зависимости из репозитория:

```bash
composer install
```

## Использование

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use Scody\TextAnonymizer\Anonymizer;

$anonymizer = new Anonymizer();

echo $anonymizer->maskEmail('secret_user@example.com');
// s*********r@example.com

echo $anonymizer->maskPhone('+1 (555) 123-4567');
// *******4567

echo $anonymizer->maskCard('4111111111115678');
// ************5678

echo $anonymizer->maskAll('Contact: secret_user@example.com, phone: +1 (555) 123-4567, card: 4111111111115678');
// Contact: s*********r@example.com, phone: *******4567, card: *********1115678
```

Дополнительный пример доступен в [`example.php`](example.php:1).

## Тесты

```bash
vendor/bin/phpunit
```

Конфигурация PHPUnit находится в [`phpunit.xml`](phpunit.xml:1), тесты — в [`AnonymizerTest.php`](tests/AnonymizerTest.php:1).
