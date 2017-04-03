<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use App\TickCircleTrueFalse;

class TickTrueFalseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($level = 1; $level<= 6; $level++) {
            // tạo random đề cho hcoj sinh
            foreach (range(1, 30) as $index) {
                $book = new TickCircleTrueFalse();

                $num_question = $faker->numberBetween($min = 3, $max = 5);
                $array_option_answers = [];
                for ($i = 1; $i <= $num_question; $i++) {

                    $array_option_answers[$i] = [
                        'id' => $i,
                        'content' => $faker->sentence(7),
                        'answer' =>  $faker->randomElement($array = array ('T', 'F'))
                    ];
                }

                $book->user_id = 3;
                $book->title = $faker->sentence(5);
                $book->content = $faker->paragraph($nbSentences = 15, $variableNbSentences = true);
                $book->content_json = json_encode($array_option_answers);
                $book->point = 100;
                $book->type_user = 'ST';

                $book->skill_id = 3;
                $book->level_id = $level;
                $book->class_id = $faker->numberBetween($min = 1, $max = 10);
                $book->exam_type_id = null;
                $book->bookmap_id = null;

                $book->created_at = null;
                $book->updated_at = null;

                $book->save();
            }
        }

        for ($class = 1; $class<= 10; $class++) {
            // tạo random đề cho giáo viên
            foreach (range(1, 30) as $index) {
                $book = new TickCircleTrueFalse();

                $num_question = $faker->numberBetween($min = 3, $max = 5);
                $array_option_answers = [];
                for ($i = 1; $i <= $num_question; $i++) {

                    $array_option_answers[$i] = [
                        'id' => $i,
                        'content' => $faker->sentence(7),
                        'answer' =>  $faker->randomElement($array = array ('T', 'F'))
                    ];
                }

                $book->title = $faker->sentence(5);
                $book->content = $faker->paragraph($nbSentences = 15, $variableNbSentences = true);
                $book->content_json = json_encode($array_option_answers);
                $book->point = 100;
                $book->type_user = 'TC';

                $book->skill_id = 3;
                $book->level_id = null;
                $book->class_id = $class;
                $book->exam_type_id = $faker->numberBetween($min = 1, $max = 4);
                $book->bookmap_id = $faker->numberBetween($min = 1, $max = 11);

                $book->created_at = null;
                $book->updated_at = null;

                $book->save();
            }
        }


    }
}
