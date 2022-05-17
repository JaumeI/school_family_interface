<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $text = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
            et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
            ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
            fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
            mollit anim id est laborum.';
        for ($i = 0; $i < 100; $i++) {
            // Let's make sure from ans to users are different
            $from = User::inRandomOrder()->first()->id;
            do {
                $to = User::inRandomOrder()->first()->id;
            } while ($to == $from);
            $send_date = Carbon::now()->subDays(rand(1, 55));

            //$content = strip_tags(file_get_contents('http://loripsum.net/api/1/short'));
            $start = rand(0,(strlen($text)-10)/2);
            $length =rand(10, (strlen($text)/2)-10);
            $content = trim(substr($text, $start,$length));
            Message::create([
                'content' => $content,
                'user_from' => $from,
                'user_to' => $to,
                'created_at' => $send_date,
                'updated_at' => $send_date,
            ]);
        }
    }
}
