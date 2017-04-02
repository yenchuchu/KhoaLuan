<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class StudentCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'student:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Sent test's result of student";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = DB::table('users')->first();
        var_dump($user);
//            dd($user);
    }
}
