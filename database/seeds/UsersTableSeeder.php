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
        foreach (range(1, 10) as $index) {
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

        $user_student = new User();

        $user_student->user_name = 'student';
        $user_student->full_name = 'Chu Thị Thúy Hiền';
        $user_student->email = 'student@gmail.com';
        $user_student->password =  bcrypt('123456');
        $user_student->remember_token =  str_random(10);
        $user_student->class_id = '3';
        $user_student->type = 2; // student
        $user_student->avatar = 'imgs-dashboard/avatar.png'; // student
        $user_student->created_at = null;
        $user_student->updated_at = null;

        $user_student->save();

        $user_admin = new User();

        $user_admin->user_name = 'admin';
        $user_admin->full_name = 'Chủ biên tập';
        $user_admin->email = 'admin@gmail.com';
        $user_admin->password =  bcrypt('admin');
        $user_admin->remember_token =  str_random(10);
        $user_admin->class_id = null;
        $user_admin->type = 3; // student
        $user_admin->avatar = 'imgs-dashboard/avatar.png'; // student
        $user_admin->created_at = null;
        $user_admin->updated_at = null;

        $user_admin->save();

        $user_author = new User();

        $user_student->user_name = 'author';
        $user_student->full_name = 'Tác giả';
        $user_student->email = 'author@gmail.com';
        $user_student->password =  bcrypt('123456');
        $user_student->remember_token =  str_random(10);
        $user_student->class_id = null;
        $user_student->type = 4; // student
        $user_student->avatar = 'imgs-dashboard/avatar.png'; // student
        $user_student->created_at = null;
        $user_student->updated_at = null;

        $user_student->save();
    }
}
