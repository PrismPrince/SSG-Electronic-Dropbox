<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->call(UserRegistrationRequestsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(PollsTableSeeder::class);
        $this->call(AnswersTableSeeder::class);
        $this->call(SuggestionsTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
    }
}
