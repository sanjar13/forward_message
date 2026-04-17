<?php

// Получаем сырое тело запроса от Telegram
$input = file_get_contents("php://input");

// URL куда переслать
$forwardUrl = "https://admin.synterra.uz/api/telegram-bot";

// Создаём контекст запроса
$options = [
    "http" => [
        "header"  => "Content-Type: application/json",
        "method"  => "POST",
        "content" => $input,
        "timeout" => 10
    ]
];

$context = stream_context_create($options);

// Отправляем
$result = file_get_contents($forwardUrl, false, $context);

// Ответ Telegram (обязательно 200 OK)
http_response_code(200);
echo "OK";