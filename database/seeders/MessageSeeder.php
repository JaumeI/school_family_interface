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
        for($i=0;$i<100;$i++)
        {
            // Let's make sure from ans to users are different
            $from = User::inRandomOrder()->first()->id;
            do{
                $to = User::inRandomOrder()->first()->id;
            }while($to == $from);
            $send_date = Carbon::now()->subDays(rand(1, 55));
            $content = strip_tags(file_get_contents('http://loripsum.net/api/1/short'));
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
