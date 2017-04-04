<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;

use App\AnswerQuestion;

class AnswerquestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // tạo random đề cho hcoj sinh
        foreach (range(1, 10) as $index) {
            $book = new AnswerQuestion();

            $num_question = $faker->numberBetween($min = 1, $max = 4);
            $array_option_answers = [];
            for ($i = 1; $i <= $num_question; $i++) {

                $array_option_answers[$i] = [
                    'id' => $i,
                    'content' => $faker->sentence(7),
                    'answer' => $faker->sentence(5)
                ];
            }

            $book->title = $faker->sentence(5);
            $book->content = $faker->paragraph($nbSentences = 15, $variableNbSentences = true);
            $book->content_json = json_encode($array_option_answers);
            $book->point = 100;
            $book->type_user = 'ST';
            $book->type_code = 5;

            $book->user_id = 3;
            $book->skill_id = 3;
            $book->level_id = 5;
            $book->class_id = 5;
            $book->exam_type_id = null;
            $book->bookmap_id = null;

            $book->created_at = null;
            $book->updated_at = null;

            $book->save();
        }
        // tạo random đề cho hcoj sinh
        foreach (range(1, 10) as $index) {
            $book = new AnswerQuestion();

            $num_question = $faker->numberBetween($min = 1, $max = 4);
            $array_option_answers = [];
            for ($i = 1; $i <= $num_question; $i++) {

                $array_option_answers[$i] = [
                    'id' => $i,
                    'content' => $faker->sentence(7),
                    'answer' => $faker->sentence(5)
                ];
            }

            $book->title = $faker->sentence(5);
            $book->content = $faker->paragraph($nbSentences = 15, $variableNbSentences = true);
            $book->content_json = json_encode($array_option_answers);
            $book->point = 100;
            $book->type_user = 'ST';
            $book->type_code = 6;

            $book->user_id = 3;
            $book->skill_id = 3;
            $book->level_id = 6;
            $book->class_id = 6;
            $book->exam_type_id = null;
            $book->bookmap_id = null;

            $book->created_at = null;
            $book->updated_at = null;

            $book->save();
        }
        // tạo random đề cho hcoj sinh
        foreach (range(1, 10) as $index) {
            $book = new AnswerQuestion();

            $num_question = $faker->numberBetween($min = 1, $max = 4);
            $array_option_answers = [];
            for ($i = 1; $i <= $num_question; $i++) {

                $array_option_answers[$i] = [
                    'id' => $i,
                    'content' => $faker->sentence(7),
                    'answer' => $faker->sentence(5)
                ];
            }

            $book->title = $faker->sentence(5);
            $book->content = $faker->paragraph($nbSentences = 15, $variableNbSentences = true);
            $book->content_json = json_encode($array_option_answers);
            $book->point = 100;
            $book->type_user = 'ST';
            $book->type_code = 4;

            $book->user_id = 3;
            $book->skill_id = 3;
            $book->level_id = 4;
            $book->class_id = 4;
            $book->exam_type_id = null;
            $book->bookmap_id = null;

            $book->created_at = null;
            $book->updated_at = null;

            $book->save();
        }
        // tạo random đề cho hcoj sinh
        foreach (range(1, 10) as $index) {
            $book = new AnswerQuestion();

            $num_question = $faker->numberBetween($min = 1, $max = 4);
            $array_option_answers = [];
            for ($i = 1; $i <= $num_question; $i++) {

                $array_option_answers[$i] = [
                    'id' => $i,
                    'content' => $faker->sentence(7),
                    'answer' => $faker->sentence(5)
                ];
            }

            $book->title = $faker->sentence(5);
            $book->content = $faker->paragraph($nbSentences = 15, $variableNbSentences = true);
            $book->content_json = json_encode($array_option_answers);
            $book->point = 100;
            $book->type_user = 'ST';
            $book->type_code = 3;

            $book->user_id = 3;
            $book->skill_id = 3;
            $book->level_id = 3;
            $book->class_id = 3;
            $book->exam_type_id = null;
            $book->bookmap_id = null;

            $book->created_at = null;
            $book->updated_at = null;

            $book->save();
        }

        // tạo random đề cho hcoj sinh
        foreach (range(1, 5) as $index) {
            $book = new AnswerQuestion();

            $num_question = $faker->numberBetween($min = 1, $max = 4);
            $array_option_answers = [];
            for ($i = 1; $i <= $num_question; $i++) {

                $array_option_answers[$i] = [
                    'id' => $i,
                    'content' => $faker->sentence(7),
                    'answer' => $faker->sentence(5)
                ];
            }

            $book->title = $faker->sentence(5);
            $book->content = $faker->paragraph($nbSentences = 15, $variableNbSentences = true);
            $book->content_json = json_encode($array_option_answers);
            $book->point = 100;
            $book->type_user = 'ST';
            $book->type_code = 2;

            $book->user_id = 3;
            $book->skill_id = 3;
            $book->level_id = 2;
            $book->class_id = 2;
            $book->exam_type_id = null;
            $book->bookmap_id = null;

            $book->created_at = null;
            $book->updated_at = null;

            $book->save();
        }

        // tạo random đề cho hcoj sinh
        foreach (range(1, 20) as $index) {
            $book = new AnswerQuestion();

            $num_question = $faker->numberBetween($min = 1, $max = 4);
            $array_option_answers = [];
            for ($i = 1; $i <= $num_question; $i++) {

                $array_option_answers[$i] = [
                    'id' => $i,
                    'content' => $faker->sentence(7),
                    'answer' => $faker->sentence(5)
                ];
            }

            $book->title = $faker->sentence(5);
            $book->content = $faker->paragraph($nbSentences = 15, $variableNbSentences = true);
            $book->content_json = json_encode($array_option_answers);
            $book->point = 100;
            $book->type_user = 'ST';
            $book->type_code = 1;

            $book->user_id = 3;
            $book->skill_id = 3;
            $book->level_id = 1;
            $book->class_id = 1;
            $book->exam_type_id = null;
            $book->bookmap_id = null;

            $book->created_at = null;
            $book->updated_at = null;

            $book->save();
        }

    }
}

