<?php

require_once __DIR__ . '/vendor/autoload.php';

use Scody\TextAnonymizer\Anonymizer;

$anonymizer = new Anonymizer();

// Примеры маскирования email
echo $anonymizer->maskEmail('secret_user@example.com') . PHP_EOL; // s*********r@example.com

// Примеры маскирования телефона
echo $anonymizer->maskPhone('+1 (555) 123-4567') . PHP_EOL; // *******4567

// Примеры маскирования карты
echo $anonymizer->maskCard('4111111111115678') . PHP_EOL; // ************5678

// Маскирование всех данных в тексте
echo $anonymizer->maskAll('User: john.doe@email.com, Phone: +1 (555) 123-4567, Card: 4111111111115678') . PHP_EOL;