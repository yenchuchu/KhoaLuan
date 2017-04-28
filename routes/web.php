<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//if (App::environment('remote')) {
   URL::forceSchema('https');
//}

Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard', 'DashboardController@redirectUrl')->name('dashboard.redirect.login');

    Route::group(array('prefix' => 'backend'), function () {

        // Admin
        Route::group(array('middleware' => 'checkRole:AD'), function () {
            // Manager Users backend
            Route::group(array('prefix' => 'manager-users'), function () {

                Route::get('/', 'backend\UserController@index')->name('backend.manager.users.index');
                Route::post('/delete', [
                    'as' => 'backend.manager.users.delete',
                    'uses' => 'backend\UserController@destroy'
                ]);
            });

            // Manager Roles - permissions backend
            Route::group(array('prefix' => 'manager-roles-permissions'), function () {

                Route::get('/',
                    'backend\RolePermissionsController@index')->name('backend.manager.roles.permissions.index');
                Route::post('/delete-roles', [
                    'as' => 'backend.manager.roles.delete',
                    'uses' => 'backend\RolePermissionsController@destroyRole'
                ]);
                Route::post('/delete-permissions', [
                    'as' => 'backend.manager.permissions.delete',
                    'uses' => 'backend\RolePermissionsController@destroyPermission'
                ]);
            });

        });

        // Author
        Route::group(array('middleware' => 'checkRole:AT'), function () {
            // Manager Users backend
            Route::group(array('prefix' => 'manager-author'), function () {

                Route::get('/', 'backend\AuthorController@index')->name('backend.manager.author.index');
                Route::get('/show-post', 'backend\AuthorController@show_post')->name('backend.manager.author.show.post');

                // go to elementary
                Route::group(array('prefix' => 'grade'), function () {
                    //odl
//                    Route::get('/{class_code}', 'backend\AuthorController@grade')->name('backend.author.grade');
                    Route::get('/', 'backend\AuthorController@grade_new')->name('backend.author.grade.new');
                });

                Route::get('/underlines',
                    'backend\AuthorController@underlines')->name('backend.manager.author.underlines');

                Route::group(array('prefix' => 'answer-question'), function () {
//                    Route::get('/{class_code}', 'backend\author\AnswerQuestionsController@index')
//                        ->name('backend.manager.author.answer-question');
//
//                    Route::get('/create/{code_user}/{class_code}', 'backend\author\AnswerQuestionsController@create')
//                        ->name('backend.manager.author.answer-question.create');

                    Route::get('/', 'backend\author\AnswerQuestionsController@index')
                        ->name('backend.manager.author.answer-question');

                    Route::get('/create/{code_user}', 'backend\author\AnswerQuestionsController@create')
                        ->name('backend.manager.author.answer-question.create');
//                    Route::get('/create-teacher/{class_code}', 'backend\author\AnswerQuestionsController@create_teacher')
//                        ->name('backend.manager.author.answer-question.create-teacher');

                    Route::post('/store', 'backend\author\AnswerQuestionsController@store')
                        ->name('backend.manager.author.answer-question.store');


                });

                Route::group(array('prefix' => 'tick-circle-true-false'), function () {
//                    Route::get('/{class_code}', 'backend\author\TickCircleTrueFalseController@index')
//                        ->name('backend.manager.author.tick-circle-true-false');
//
//                    Route::get('/create/{code_user}/{class_code}',
//                        'backend\author\TickCircleTrueFalseController@create')
//                        ->name('backend.manager.author.tick-circle-true-false.create');

                    Route::get('/', 'backend\author\TickCircleTrueFalseController@index')
                        ->name('backend.manager.author.tick-circle-true-false');

                    Route::get('/create/{code_user}',
                        'backend\author\TickCircleTrueFalseController@create')
                        ->name('backend.manager.author.tick-circle-true-false.create');

                    Route::post('/store', 'backend\author\TickCircleTrueFalseController@store')
                        ->name('backend.manager.author.tick-circle-true-false.store');
                });

                Route::group(array('prefix' => 'multiple-choice'), function () {
//                    Route::get('/{class_code}', 'backend\author\MultipleChoiceController@index')
//                        ->name('backend.manager.author.multiple-choice');
//
//                    Route::get('/create/{code_user}/{class_code}', 'backend\author\MultipleChoiceController@create')
//                        ->name('backend.manager.author.multiple-choice.create');

                    Route::get('/', 'backend\author\MultipleChoiceController@index')
                        ->name('backend.manager.author.multiple-choice');

                    Route::get('/create/{code_user}', 'backend\author\MultipleChoiceController@create')
                        ->name('backend.manager.author.multiple-choice.create');

                    Route::post('/store', 'backend\author\MultipleChoiceController@store')
                        ->name('backend.manager.author.multiple-choice.store');
                });

                Route::group(array('prefix' => 'classify-word'), function () {
//                    Route::get('/{class_code}', 'backend\author\ClassifyWordController@index')
//                        ->name('backend.manager.author.classify-word');
//
//                    Route::get('/create/{code_user}/{class_code}', 'backend\author\ClassifyWordController@create')
//                        ->name('backend.manager.author.classify-word.create');

                   Route::get('/', 'backend\author\ClassifyWordController@index')
                        ->name('backend.manager.author.classify-word');

                    Route::get('/create/{code_user}', 'backend\author\ClassifyWordController@create')
                        ->name('backend.manager.author.classify-word.create');

                    Route::post('/store', 'backend\author\ClassifyWordController@store')
                        ->name('backend.manager.author.classify-word.store');
                });

                Route::group(array('prefix' => 'complete-word'), function () {
//                    Route::get('/{class_code}', 'backend\author\CompleteWordController@index')
//                        ->name('backend.manager.author.complete-word');
//
//                    Route::get('/create/{code_user}/{class_code}', 'backend\author\CompleteWordController@create')
//                        ->name('backend.manager.author.complete-word.create');

                    Route::get('/', 'backend\author\CompleteWordController@index')
                        ->name('backend.manager.author.complete-word');

                    Route::get('/create/{code_user}', 'backend\author\CompleteWordController@create')
                        ->name('backend.manager.author.complete-word.create');

                    Route::post('/store', 'backend\author\CompleteWordController@store')
                        ->name('backend.manager.author.complete-word.store');
                });

                Route::group(array('prefix' => 'complete-paragraph'), function () {
//                    Route::get('/{class_code}', 'backend\author\CompleteParagraphController@index')
//                        ->name('backend.manager.author.complete-paragraph');
//
//                    Route::get('/create/{code_user}/{class_code}', 'backend\author\CompleteParagraphController@create')
//                        ->name('backend.manager.author.complete-paragraph.create');
//
//                    Route::post('/store', 'backend\author\CompleteParagraphController@store')

                    Route::get('/', 'backend\author\CompleteParagraphController@index')
                        ->name('backend.manager.author.complete-paragraph');

                    Route::get('/create/{code_user}', 'backend\author\CompleteParagraphController@create')
                        ->name('backend.manager.author.complete-paragraph.create');

                    Route::post('/store', 'backend\author\CompleteParagraphController@store')
                        ->name('backend.manager.author.complete-paragraph.store');
                });

                Route::group(array('prefix' => 'find-errors'), function () {
//                    Route::get('/{class_code}', 'backend\author\FindErrorController@index')
//                        ->name('backend.manager.author.find-errors');
//
//                    Route::get('/create/{code_user}/{class_code}', 'backend\author\FindErrorController@create')
//                        ->name('backend.manager.author.find-errors.create');

                    Route::get('/', 'backend\author\FindErrorController@index')
                        ->name('backend.manager.author.find-errors');

                    Route::get('/create/{code_user}/', 'backend\author\FindErrorController@create')
                        ->name('backend.manager.author.find-errors.create');

                    Route::post('/store', 'backend\author\FindErrorController@store')
                        ->name('backend.manager.author.find-errors.store');
                });

                /**
                 * Route: LISTENING
                 */
                Route::group(array('prefix' => 'listening'), function () {
                    Route::group(array('prefix' => 'listen_complete_sentences'), function () {
//                        Route::get('/{class_code}', 'backend\author\ListenCompleteSentencesController@index')
//                            ->name('backend.manager.author.listen.listen_complete_sentences');
//
//                        Route::get('/create/{code_user}/{class_code}', 'backend\author\ListenCompleteSentencesController@create')
//                            ->name('backend.manager.author.listen.listen_complete_sentences.create');

                        Route::get('/', 'backend\author\ListenCompleteSentencesController@index')
                            ->name('backend.manager.author.listen.listen_complete_sentences');

                        Route::get('/create/{code_user}', 'backend\author\ListenCompleteSentencesController@create')
                            ->name('backend.manager.author.listen.listen_complete_sentences.create');

                        Route::post('/store', 'backend\author\ListenCompleteSentencesController@store')
                            ->name('backend.manager.author.listen.listen_complete_sentences.store');
                    });

                    Route::group(array('prefix' => 'listen_table_ticks'), function () {
//                        Route::get('/{class_code}', 'backend\author\ListenTableTicksController@index')
//                            ->name('backend.manager.author.listen.listen_table_ticks');
//
//                        Route::get('/create/{code_user}/{class_code}', 'backend\author\ListenTableTicksController@create')
//                            ->name('backend.manager.author.listen.listen_table_ticks.create');

                        Route::get('/', 'backend\author\ListenTableTicksController@index')
                            ->name('backend.manager.author.listen.listen_table_ticks');

                        Route::get('/create/{code_user}', 'backend\author\ListenTableTicksController@create')
                            ->name('backend.manager.author.listen.listen_table_ticks.create');

                        Route::post('/store', 'backend\author\ListenTableTicksController@store')
                            ->name('backend.manager.author.listen.listen_table_ticks.store');
                    });

                    Route::group(array('prefix' => 'listen_ticks'), function () {
//                        Route::get('/{class_code}', 'backend\author\ListenTicksController@index')
//                            ->name('backend.manager.author.listen.listen_ticks');
//
//                        Route::get('/create/{code_user}/{class_code}', 'backend\author\ListenTicksController@create')
//                            ->name('backend.manager.author.listen.listen_ticks.create');

                        Route::get('/', 'backend\author\ListenTicksController@index')
                            ->name('backend.manager.author.listen.listen_ticks');

                        Route::get('/create/{code_user}', 'backend\author\ListenTicksController@create')
                            ->name('backend.manager.author.listen.listen_ticks.create');

                        Route::post('/store', 'backend\author\ListenTicksController@store')
                            ->name('backend.manager.author.listen.listen_ticks.store');
                    });
                });

                /**
                 * Route: SPEAKING
                 */
                Route::group(array('prefix' => 'speaking'), function () {
//                    Route::get('/{class_code}', 'backend\author\SpeakingController@index')
//                        ->name('backend.manager.author.speaking');
//
//                    Route::get('/create/{code_user}/{class_code}', 'backend\author\SpeakingController@create')
//                        ->name('backend.manager.author.speaking.create');

                     Route::get('/', 'backend\author\SpeakingController@index')
                        ->name('backend.manager.author.speaking');

                    Route::get('/create/{code_user}/', 'backend\author\SpeakingController@create')
                        ->name('backend.manager.author.speaking.create');

                    Route::post('/store', 'backend\author\SpeakingController@store')
                        ->name('backend.manager.author.speaking.store');
                });
            });

        });

        Route::get('/get-detail/{name_table}/{user_auth_id}/{id_string}', 'backend\AuthorController@get_detail')->name('backend.manager.author.get.detail');
        Route::post('/post-detail', 'backend\AuthorController@post_detail')->name('backend.manager.author.post.detail');


//        update Listen
        Route::post('/update-listen-table-ticks', 'backend\author\ListenTableTicksController@update')
            ->name('backend.manager.author.listen.listen_table_ticks.update');

        Route::post('/update-listen-complete-sentences', 'backend\author\ListenCompleteSentencesController@update')
            ->name('backend.manager.author.listen.listen_complete_sentences.update');

        Route::post('/update-listen-ticks', 'backend\author\ListenTicksController@update')
            ->name('backend.manager.author.listen.listen_ticks.update');

//        Update Read
        Route::post('/update/answer-questions', 'backend\author\AnswerQuestionsController@update')
            ->name('backend.manager.author.read.answer_questions.update');

        Route::post('/update/find-errors', 'backend\author\FindErrorController@update')
            ->name('backend.manager.author.read.find_errors.update');

        Route::post('/update/multiple-choices', 'backend\author\MultipleChoiceController@update')
            ->name('backend.manager.author.read.multiple_choices.update');

        Route::post('/update/tick-true-false', 'backend\author\TickCircleTrueFalseController@update')
            ->name('backend.manager.author.read.tick_circle_true_falses.update');

        // SPEAKING
        Route::post('/update/speaking', 'backend\author\SpeakingController@update')
            ->name('backend.manager.author.speakings.update');

        // SHOW ALL NOTIFICATIONS
        Route::post('/all-noti', 'backend\AuthorController@show_all_noti')
            ->name('backend.manager.backend.all.noti');


    });

    Route::group(array('prefix' => 'frontend'), function () {

        // Teacher frontend
        Route::group(array('prefix' => 'teacher', 'middleware' => 'checkRole:TC'), function () {

            // dashboard
            Route::get('/', 'frontend\TeacherController@index')->name('frontend.teacher.index');

            // go to elementary
            Route::group(array('prefix' => 'elementary'), function () {
                Route::get('/', 'frontend\TeacherController@elementary')->name('frontend.teacher.elementary');
                Route::get('/get-unit-class', 'frontend\TeacherController@get_unit_class')
                    ->name('frontend.teacher.elementary.get.unit');
                Route::get('/get-examtype-ofskill', 'frontend\TeacherController@get_examtype_skill')
                    ->name('frontend.teacher.elementary.get.examtype.ofSkill');

                Route::post('/create', 'frontend\TeacherController@store')->name('frontend.teacher.elementary.store');
                Route::get('/show', 'frontend\TeacherController@show')->name('frontend.teacher.elementary.show');

            });

            // go to secondary
            Route::group(array('prefix' => 'secondary'), function () {
                Route::get('/', 'frontend\TeacherController@secondary')->name('frontend.teacher.secondary');

                Route::get('/create', 'frontend\TeacherController@create')->name('frontend.teacher.secondary.create');

            });

            // go to highschool
            Route::group(array('prefix' => 'highschool'), function () {
                Route::get('/', 'frontend\TeacherController@highschool')->name('frontend.teacher.highschool');

                Route::get('/create', 'frontend\TeacherController@create')->name('frontend.teacher.highschool.create');

            });

        });

        // STUDENT FRONTEND
        Route::group(array('prefix' => 'student', 'middleware' => 'checkRole:ST'), function () {

            // dashboard
            Route::get('/', 'frontend\StudentController@index')->name('frontend.dashboard.student.index');

            Route::get('/learn-speak',
                'frontend\StudentController@learn_speak')->name('frontend.dashboard.student.learn.speak');
//            Route::post('/next-level-speak',
//                'frontend\StudentController@learn_speak')->name('frontend.dashboard.student.next-level.speak');

            Route::get('/redirect-to-test-page/{skill_code}', 'frontend\StudentController@redirectToTest')
                ->name('frontend.dashboard.student.redirect');

            Route::get('/redirect-to-test-page-listen/{skill_code}', 'frontend\StudentController@redirectToTestListen')
                ->name('frontend.dashboard.student.redirect.listen');
// Route::get('/redirect-to-test-page/{level_id}', 'frontend\StudentController@redirectToTest')
//                ->name('frontend.dashboard.student.redirect');

            Route::post('check_text_speech', 'frontend\StudentController@check_text_speech')
                ->name('frontend.student.testing.check_text_speech');

            Route::post('handling-result', 'frontend\StudentController@hanglingResult')
                ->name('frontend.student.testing.handle');
            Route::post('handling-result-listen', 'frontend\StudentController@hanglingResultListen')
                ->name('frontend.student.testing.listen.handle');

            Route::post('restart-delete-item', 'frontend\StudentController@restartDeleteItem')
                ->name('frontend.student.testing.restart.delete.item');

            Route::get('show_results', 'frontend\StudentController@show_results')
                ->name('frontend.student.show.results');
        });

    });

    Route::get('/setup/roles', 'SetupRoleController@setupRole')->name('get.setup.roles');
    Route::post('post/setup/roles', 'SetupRoleController@postSetupRole')->name('post.setup.roles');

    // show profile
    Route::get('profile', 'frontend\StudentController@profile')
        ->name('frontend.student.show.profile');
    Route::post('change/profile/avatar/{id}', 'frontend\StudentController@change_avatar')
        ->name('frontend.student.change.profile.avatar');
    Route::post('change/profile/infomation/{id}', 'frontend\StudentController@change_infomation')
        ->name('frontend.student.change.profile.infomation');

});

//Route::group(array('middleware' => 'guest'), function () {
// dashboard
//Route::group(array('middleware' => 'checkRole:TC|AU|guest'), function () {
Route::get('/', 'DashboardController@index')->name('dashboard');
Route::get('/test-design', 'DashboardController@dashboardDesign')->name('dashboard.design');
//});

Auth::routes();
Route::get('register', 'Auth\RegisterController@showRegistrationFormReset')->name('register');

Route::get('login/facebook', 'Auth\LoginController@redirectToProvider')->name('login.facebook');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/403', function () {
    return view('errors.403');
});

Route::get('test/send-email', 'TestEmailController@ship');
