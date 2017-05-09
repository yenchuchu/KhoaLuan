<?php

return [
    'backend' => [
        'author' => [
            'speaking' => [
                'grade_menu' => [
                    'content' => 'Speaking again',
                ],
                'index' => [
                    'title' => 'Create test',
                    'table' => 'Manager tests',
                    'add' => 'Create new questions',
                    'manage-table' => ' Manager own questions',
                ],
                'create' => [
                    'title' => 'Create test by levels and classes',
                ]
            ],
            'listening' => [
                'grade_menu' => [
                    'listen_ticks' => 'Listen Ticks',
                    'listen_complete_sentences' => 'Listen Complete Sentences',
                    'listen_table_ticks' => 'Listen Table Ticks',
                ],
            ],
            'reading' => [
                'grade_menu' => [
                    'answer_question' => 'Answer Questions',
                    'find_error' => 'Find Errors',
                    'multiple_choice' => 'Multiple choices',
                    'tick_true_false' => 'Tick True False',
                ],
            ],
            'dashboard' => 'Create Exam For ',
        ],
        'dashboard' => 'Dashboard',
        'table' => [
            'class' => 'Class',
            'level' => 'Level',
            'link' => 'Link',
            'date' => 'Date',
            'status' => 'Status',
            'go_to_link' => 'Link',
            'done' => 'Done',
            'wait' => 'Wait'
        ],
        'create' => [
            'title' => 'Create questions',
            'title-question' => 'Enter title',
            'content-question' => 'Enter the passage',
            'item-content-question' => 'Enter question content',
            'answer-question' => 'Enter answer',
            'upload_audio' => 'Upload Audio',
            'suggest_answer' => 'Suggest answer'
        ]
    ],
    'frontend' => [
        'introduce' => 'DASHBOARD',
        'test_reading' => 'READING',
        'test_listening' => 'LISTENING',
        'test_speaking' => 'SPEAKING',
        'result' => 'RESULT',
        'continue' => 'Continue',
        'restart' => 'Restart',
        'submit' => 'Send',
        'start' => 'Start',
        'stop' => 'Stop',
        'confirm_restart' => 'Do you want to continue?',
        'heading' => [
        'test_reading' => 'Reading Test',
        'test_listening' => 'Listening Test',
        'test_speaking' => 'Speaking Test',
        'result' => 'Result',
],
        'no_data' => 'No data',
    ],
    'skills' => [
        'speaking' => 'Speaking skill',
        'reading' => 'Reading skill',
        'listening' => 'Listening skill',
        'title' => [
            'read' => 'Read',
            'listen' => 'Listen',
            'speak' => 'Speak',
            'scale' => 'Scale',
            'order' => 'Order',
            'point' => 'Point',
            'date' => 'Date'
        ]
    ],
    'user' => [
        'profile' => 'Profile',
        'user_name' => 'User name',
        'full_name' => 'Full name',
        'email' => 'Email',
        'change_ava' => 'To change your avatar successful!',
        'no_change' => 'No change!',
        'change_info' => 'To change your information successful!',

    ],
    'auth' => [
        'login' => [
            'title' => 'Login',
            'email' => 'Your E-Mail', //E-Mail Address
            'password' => 'Password',
            'remember' => 'Remember Account',
            'forgot_password' => 'Forget Password?',
        ],
        'register' => [
            'title' => 'Register',
            'full_name' => 'Full Name',
            'user_name' => 'Username',
            'email' => 'Your Email', //E-Mail Address
            'password' => 'Password',
            'confirm_password' => 'Confirm Password',
            'choose_type' => 'Choose user',
            'student_type' => 'STUDENT',
            'author_type' => 'AUTHOR',
            'class' => 'Choose Class',
        ],
        'main' => [
            'session1' => [
                'title' => 'Come with us',
                'content' => 'EStore is a wonderful place for people who from 3-12 grades to share knowledge together.
                The knowledge will be admin check and confirm.',
            ],
            'session2' => [
                'title' => 'AT YOUR SERVICE', //
                'content' => [
                    'one' => 'Practice Skills',
                    'title_one' => 'You can practice three skills as Reading, Listening and Speaking',
                    'two' => 'Share Knowledge',
                    'title_two' => 'Every one can share their knowledge to the website',
                    'three' => 'Connect Other',
                    'title_three' => 'People can communicate each others',
                    'four' => 'Up To Update',
                    'title_four' => 'The knowledge will update day by day',
                ],
            ],
            'session3' => [
                'title' => 'Use Free', // AT YOUR SERVICE
                'content' => [
                    'one' => 'Luyện các kỹ năng',
                    'two' => 'Chia sẻ kiến thức',
                    'three' => 'Kết nối mọi người',
                    'four' => 'Cập nhật liên tục'
                ],
            ],
            'session4' => [
                'title' => 'Contact', // AT YOUR SERVICE
                'content' => ' Please feel free to contact us if you need any further information about the website',
            ]
        ]
    ],
    'table' => [
        'view' => 'View',
        'record' => 'record',
        'search' => 'Search',
        'no_record' => 'No result',
        'first' => 'First',
        'last' => 'Last'
    ]
];