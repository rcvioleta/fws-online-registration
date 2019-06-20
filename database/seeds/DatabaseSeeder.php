<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\User;
use App\Model\Event;
use App\Model\Campaign;
use App\Model\Employee;
use App\Model\Team;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('secret'),
            'remember_token' => Str::random(10)
        ]);

        factory(Event::class, 5)->create();
        factory(Campaign::class, 10)->create();
        factory(Team::class, 5)->create();

        
        $chunk = 500;
        $chunk_counter = $chunk;
        $chunk_total = 1000;

        while ($chunk_total >= $chunk_counter) {
            factory(Employee::class, $chunk)->create();
            $chunk_counter += $chunk;
        }
    }
}
