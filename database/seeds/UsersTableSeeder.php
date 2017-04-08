<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Faker\Factory as Faker;

use App\User;

class UsersTableSeeder extends Seeder
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
        foreach (range(1, 30) as $index) {
            $user = new User();

            $user->user_name = $faker->userName;
            $user->full_name = $faker->name;
            $user->email = $faker->email;
            $user->password =  bcrypt('123456');
            $user->remember_token =  str_random(10);
            $user->class_id = $faker->numberBetween($min = 1, $max = 10);
            $user->type = 2; // student
            $user->avatar = 'imgs-dashboard/avatar.png'; // student
            $user->created_at = null;
            $user->updated_at = null;

            $user->save();
        }
    }
}
