<?php

return [

    'login' => [
        'success' => [
            'success' => [
                'message' => 'Успешный вход в систему',
            ],
            'reload' => true,
        ],
        'error' => [
            'error' => [
                'message' => 'Неправильный логин или пароль',
            ],
        ],
    ],

    'logout' => [
        'success' => [
            'success' => [
                'message' => 'Вы вышли из системы',

            ],
            'reload' => true,
        ],
    ],

    'register' => [
        'success' => [
            'success' => [
                'message' => 'Успешная регистрация'
            ],
        ],
        'error' => [
            'error' => [
                'message' => 'Ошибка регистрации'
            ],
        ],
        'impossible' => [
            'error' => [
                'message' => 'На email <strong>%email%</strong> уже была зарегистрирована учетная запись пользователя данной системы.<br>Пожалуйста, воспользуйтесь службой восстановления доступа или зарегистрируйте новую учетную запись на другой email.<br>Зарегистрировать более одного аккаунта на один email невозможно.'
            ],
        ],
    ],

    'accessRestore' => [
        'success' => [
            'success' => [
                'message' => 'На Ваш email %email% был выслан пароль для входа в систему'
            ],
        ],
        'error' => [
            'error' => [
                'message' => 'Ошибка восстановления доступа. Обратитесь к администратору сайта'
            ],
        ],
        'noUser' => [
            'error' => [
                'message' => 'Учетная запись на указанный email не зарегистрирована'
            ],
        ],
    ],

    'currency' => [
        'success' => [
            'success' => [
                'message' => 'Курс валют успешно обновлен'
            ],
        ],
        'error' => [
            'error' => [
                'message' => 'Ошибка обновления курса валют'
            ],
        ],
    ],

    'offers' => [
        'success' => [
            'success' => [
                'message' => 'Новая закупка успешно добавлена'
            ],
        ],
        'error' => [
            'error' => [
                'message' => 'Ошибка добавления новой закупки'
            ],
        ],
    ],

    'orders' => [
        'success' => [
            'success' => [
                'message' => 'Новая заявка успешно добавлена'
            ],
        ],
        'error' => [
            'error' => [
                'message' => 'Ошибка добавления новой заявки'
            ],
        ],
    ],

    'statusChange' => [
        'success' => [
            'success' => [
                'message' => 'Статус успешно изменен'
            ],
        ],
        'error' => [
            'error' => [
                'message' => 'Ошибка изменения статуса'
            ],
        ],
    ],

    'towns' => [
        'success' => [
            'success' => [
                'message' => 'Список городов успешно изменен',
            ],
            'mainReload' => true
        ],
        'error' => [
            'error' => [
                'message' => 'Ошибка изменения списка городов'
            ],
        ],
    ],

    'countries' => [
        'success' => [
            'success' => [
                'message' => 'Список стран успешно изменен',
            ],
            'mainReload' => true
        ],
        'error' => [
            'error' => [
                'message' => 'Ошибка изменения списка стран'
            ],
        ],
    ],
];
