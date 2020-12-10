<?php


return [

    'user' => [
        'username'      => 'Псевдоним',
        'name'          => 'Имя',
        'email'         => 'Эл.почта',
        'phone'         => 'Телефон',
        'last_visit'    => 'Последний визит',
        'register_date' => 'Дата регистрации',
        'status'        => 'Статус',
        'statusDict'    => [
            'user'        => 'Участник',
            'organizator' => 'Организатор',
            'guest'       => 'Гость',
        ]
    ],

    'offer' => [
        'active'       => 'Активно',
        'stop'         => 'Стоп',
        'payment'      => 'Оплата',
        'transit'      => 'В пути',
        'delivered'    => 'Прибытие',
        'refund'       => 'Возврат',
        'completed'    => 'Завершено',
    ],
];
