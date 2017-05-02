<?php
return [
    'skill' => [
        // key's name is name model.
        'Read' => [
            'answer_questions' => 'Answer and question',
//            'complete_words' => 'Complete words',
            'find_errors' => 'Find Errors',
            'multiple_choices' => 'Multiple choice',
            'tick_circle_true_falses' => 'Tick circle true or false',
//            'classify_words' => 'Classify words',
//            'underlines' => 'Underlines',
        ],
        'Listen' => [
//            'listen_complete_tables' => 'Complete Table',
            'listen_table_ticks' => 'Table Tick',
            'listen_table_matchs' => 'Table Matchs',
            'listen_complete_sentences' => 'Complete Sentences',
            'listen_ticks' => 'Listen and Tick',
//            'listen_tick_crosses' => 'Tick Cross',
//            'listen_fill_numbers' => 'Listen And Fill In One Number',
        ],
        'Write' => [],
        'Speak' => []

    ],
    // point = 20 tương ứng với mỗi bài. chia đều 20 điểm cho tất cả số câu trong bài.
//    'point' => 25,
    'sum_point' => 30,
    'max_exam' => 3, // số bài trong 1 đề, các kỹ năng nghe -đọc có số bài giống nhau.
    'time_start' => 3600, // 60 phuts cho 1 bai thi
    'lama' => [
        '1' => 'I',
        '2' => 'II',
        '3' => 'III',
        '4' => 'IV',
        '5' => 'V',
        '6' => 'VI',
        '7' => 'VII',
    ],
    'alphab' => [
        '1' => 'A',
        '2' => 'B',
        '3' => 'C',
        '4' => 'D',
        '5' => 'E',
        '6' => 'F',
        '7' => 'G',
        '8' => 'H',
    ]

];
