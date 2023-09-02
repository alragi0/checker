<?php
if(strpos($message, '!help') === 0 or strpos($message, '/help') === 0 or strpos($message, '.help') === 0){
    $keyboard = [
        'inline_keyboard' => [
            [
                ['text' => 'Free', 'callback_data' => 'free'],
            ],
            [
                ['text' => 'Premium', 'callback_data' => 'paid'],
            ],
            [
                ['text' => 'Others', 'callback_data' => 'others'],
            ],
            [
                ['text' => 'Finalize', 'callback_data' => 'end'],
            ],
            [
                ['text' => 'Channel Dev', 'url' => 'https://t.me/ALRAGI1'],
            ],
        ],
    ];
    $encodedKeyboard = json_encode($keyboard);
    sendaction($chatId, typing);
    bot('sendmessage', [
        'chat_id' => $chatId,
        'reply_to_message_id' => $message_id,
        'text' => "<b>HEY <a href='tg://user?id=$gId'>$firstname</a> Hit /register to use me by the way your Id is <code>$gId</code> and current date and time at Yemen 🇾🇪🇶 Is $currentTime
This Bot Is Made With ♥️ By @YYNXX
Check Out My Commands Down</b>",
        'parse_mode' => 'HTML',
        'reply_markup' => $encodedKeyboard
    ]);
}
