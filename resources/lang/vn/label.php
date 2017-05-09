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
        ],
        'admin' => [
            'manager_student' => 'Quản lý học sinh',
            'manager_author' => 'Quản lý tác giả',
            'manager_admin' => 'Quản lý quản trị viên',
            'table' => [
                'order' => 'STT',
                'full_name' => 'Họ và tên',
                'email' => 'Hộp thư điện tử',
                'class' => 'Lớp',
                'action' => 'Xóa'
            ]
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
        'stop' => 'Dừng',
        'confirm_restart' => 'Bạn có muốn tiếp tục không?',
        'heading' => [
            'test_reading' => 'Luyện kỹ năng đọc',
            'test_listening' => 'Luyện kỹ năng nghe',
            'test_speaking' => 'Luyện kỹ năng nói',
            'result' => 'Kết quả',
        ],
        'no_data' => 'Chưa có dữ liệu',
    ],
    'skills' => [
        'speaking' => 'Kỹ năng nói',
        'reading' => 'Kỹ năng đọc',
        'listening' => 'Kỹ năng nghe',
        'title' => [
            'read' => 'Đọc',
            'listen' => 'Nghe',
            'speak' => 'Nói',
            'scale' => 'Thang điểm',
            'order' => 'Lần thi',
            'point' => 'Điểm',
            'date' => 'Ngày thi'
        ]
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
        ],
        'main' => [
            'session1' => [
                'title' => 'Hãy đến với chúng tôi',
                'content' => 'EStore là nơi để các bạn cùng nhau trao đổi kiến thức môn tiếng Anh các bậc tiểu học, trung học cơ sở và trung học phổ thông. Từ những kiến thức được kiểm duyệt, các em học sinh sẽ tự rèn luyện kỹ năng tiếng Anh của mình với những kiến thức đó.',
            ],
            'session2' => [
                'title' => 'Cung cấp cho bạn', // AT YOUR SERVICE
                'content' => [
                    'one' => 'Luyện các kỹ năng',
                    'title_one' => 'Các bạn được luyện 3 kỹ năng nghe, đọc và nói theo lớp',
                    'two' => 'Chia sẻ kiến thức',
                    'title_two' => 'Bất kỳ ai cũng có thể chia sẻ kiến thức về tiếng Anh các bậc Tiểu học, Trung học cơ sở 
                    và Trung học phổ thông',
                    'three' => 'Kết nối mọi người',
                    'title_three' => 'Là trang mạng xã hội, nơi mọi người có thể gắn kết với nhau',
                    'four' => 'Cập nhật liên tục',
                    'title_four' => 'Kiến thức được cập nhật liên tục',
                ],
            ],
            'session3' => [
                'title' => 'Sử dụng miễn phí', // AT YOUR SERVICE
                'content' => [
                    'one' => 'Luyện các kỹ năng',
                    'two' => 'Chia sẻ kiến thức',
                    'three' => 'Kết nối mọi người',
                    'four' => 'Cập nhật liên tục'
                ],
            ],
            'session4' => [
                'title' => 'Liên hệ', // AT YOUR SERVICE
                'content' => 'Hãy liên hệ với chúng tôi nếu bạn có bất cứ đóng góp hoặc thắc mắc gì về trang web.',
            ]
        ]
    ],
    'table' => [
        'view' => 'Xem',
        'record' => 'kết quả',
        'search' => 'Tìm kiếm',
        'no_record' => 'Không có kết quả',
        'first' => 'Đầu',
        'last' => 'Cuối'
    ]
];