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
                    'add' => 'Thêm',
                    'manage-table' => ' Quản lí câu hỏi',
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
                    'listen_table_ticks' => 'Nghe và chọn đáp án dựa vào bảng',
                    'listen_table_match' => 'Nghe và nối 2 cột trong bảng',
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
        'table' => [
            'class' => 'Lớp',
            'level' => 'Mức khó',
            'link' => 'liên kết',
            'date' => 'Ngày đăng',
            'status' => 'Trạng thái đăng bài',
            'go_to_link' => 'Liên kết',
            'done' => 'Đã phê duyệt',
            'wait' => 'Chờ phê duyệt'
        ],
        'create' => [
            'title' => 'Thêm',
            'title-question' => 'Nhập đề bài',
            'content-question' => 'Nhập đoạn văn',
            'item-content-question' => 'Nhập câu hỏi',
            'answer-question' => 'Nhập đáp án',
            'upload_audio' => 'Tải file nghe',
            'suggest_answer' => 'Gợi ý đáp án'
        ],
        'post_details' => [
            'title' => 'Chi tiết bài đăng',
            'confirmed' => 'Đã phê duyệt',
            'save-confirm' => 'Lưu và phê duyệt',
            'change-audio' => 'Thay đổi file nghe',
            'default-audio-gg' => 'File nghe được mặc định theo Google API',
        ]
    ],
    'frontend' => [
        'introduce' => 'TRANG CHỦ',
        'test_reading' => 'LUYỆN ĐỌC',
        'test_listening' => 'LUYỆN NGHE',
        'test_speaking' => 'LUYỆN NÓI',
        'result' => 'KẾT QUẢ',
        'continue' => 'Tiếp tục',
        'restart' => 'Làm lại',
        'submit' => 'Nộp bài',
        'start' => 'Bắt đầu',
        'stop' => 'Dừng'
    ],
    'skills' => [
        'speaking' => 'Kỹ năng nói',
        'reading' => 'Kỹ năng đọc',
        'listening' => 'Kỹ năng nghe',
    ],
    'user' => [
        'profile' => 'THÔNG TIN CÁ NHÂN',
        'user_name' => 'Tên đại diện',
        'full_name' => 'Họ và Tên',
        'class' => 'Lớp',
        'email' => 'Hộp Thư',
        'change_ava' => 'Thay đổi ảnh đại diện thành công!',
        'no_change' => 'Không có gì thay đổi!',
        'change_info' => 'Thay đổi thông tin thành công!',
    ],
    'auth' => [
        'login' => [
            'title' => 'Đăng nhập',
            'email' => 'Địa chỉ Email', //E-Mail Address
            'password' => 'Mật khẩu',
            'remember' => 'Nhớ tài khoản',
            'forgot_password' => 'Quên mật khẩu?',
        ],
        'register' => [
            'title' => 'Đăng ký',
            'full_name' => 'Họ tên đầy đủ',
            'user_name' => 'Tên đăng nhập',
            'email' => 'Địa chỉ Email', //E-Mail Address
            'password' => 'Mật khẩu',
            'confirm_password' => 'Nhập lại mật khẩu',
            'choose_type' => 'Chọn đối tượng',
            'student_type' => 'HỌC SINH',
            'author_type' => 'TÁC GIẢ',
            'class' => 'Chọn lớp',
        ]
    ]
];