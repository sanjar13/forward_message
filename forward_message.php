<?php

// Получаем сырое тело запроса от Telegram
$input = file_get_contents("php://input");

// URL куда переслать
$forwardUrl = "https://admin.synterra.uz/api/telegram-bot";
$HTTP_X_TELEGRAM_BOT_API_SECRET_TOKEN = "67331cd81b38f9a897e28fa5c373e0fea732e529e5fe54473b12896fd34861da";

// Создаём контекст запроса
$options = [
    "http" => [
        "header"  => "Content-Type: application/json\nHTTP_X_TELEGRAM_BOT_API_SECRET_TOKEN: $HTTP_X_TELEGRAM_BOT_API_SECRET_TOKEN",
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