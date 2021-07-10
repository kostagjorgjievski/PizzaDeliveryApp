<?php

use Illuminate\Database\Seeder;

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
        $user = User::where('email', 'gjorgjievskikosta@gmail.com')->first();

        if(!$user){
            User::create([
                'name' => 'Kosta Gjorgjievski',
                'email' => 'gjorgjievskikosta@gmail.com',
                'password' => Hash::make('050998koki'),
                'phone' => "078265509",
                'role' => 'admin',
            ]);
        }else{
            $user['role'] = 'admin';
        }
    }
}
