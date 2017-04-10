<?php

return [
    'backend' => [
        'author' => [
            'speaking' => [
                'grade_menu' => [
                    'content' => 'Nói theo nội dung cho sẵn',
                ],
                'index' => [
                    'title' => 'Tạo đề cho kỹ năng nói',
                    'table' => 'Quản lí đề đã tạo',
                    'add' => 'Tạo câu hỏi mới',
                    'manage-table' => ' Quản lí câu hỏi đã tạo',
                ],
                'create' => [
                    'title' => 'Tạo đề theo độ khó và lớp',
                    'placeholder' => 'Nhập câu hoặc đoạn văn',
                    'button' => [
                        'add-radio' => 'Tải audio',
                    ]
                ]
            ],
            'listening' => [
                'grade_menu' => [
                    'listen_ticks' => 'Nghe và chọn ảnh phù hợp',
                    'listen_complete_sentences' => 'Nghe và hoàn thành câu',
                    'listen_table_ticks' => 'Nghe và chọn đáp án đúng dựa vào bảng',
                ],
            ],
            'reading' => [
                'grade_menu' => [
                    'answer_question' => 'Đọc đoạn văn và trả lời câu hỏi',
                    'find_error' => 'Tìm lỗi sai trong câu',
                    'multiple_choice' => 'Chọn 1 trong 3 đáp án',
                    'tick_true_false' => 'Đọc đoạn văn và chọn đúng sai',
                ],
            ],
            'dashboard' => 'Tạo câu hỏi cho  ',
        ],
        'dashboard' => 'Trang chủ',
    ],
    'skills' => [
        'speaking' => 'Kỹ năng nói',
        'reading' => 'Kỹ năng đọc',
        'listening' => 'Kỹ năng nghe',
    ]
];