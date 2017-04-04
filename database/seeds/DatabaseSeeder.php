<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//         $this->call(UsersTableSeeder::class);
//         $this->call(AnswerquestionsTableSeeder::class);
//         $this->call(TickTrueFalseTableSeeder::class);
//         $this->call(ListenCompleteSentencesTableSeeder::class);
//         $this->call(ListenTableTicksTableSeeder::class);
//         $this->call(ListenTableMatchsTableSeeder::class);
         $this->call(ListenTicksTableSeeder::class);
    }
}
