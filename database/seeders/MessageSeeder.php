<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\DB;

class MessageSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::whereIn('id', [1, 2, 3, 4, 5, 6])->get();

        $sampleMessages = [
            "Lorem ipsum dolor sit amet.",
            "Consectetur adipiscing elit sed do.",
            "Eiusmod tempor incididunt ut labore.",
            "Et dolore magna aliqua ut enim.",
            "Ad minim veniam quis nostrud.",
            "Exercitation ullamco laboris nisi ut.",
            "Aliquip ex ea commodo consequat.",
            "Duis aute irure dolor in reprehenderit.",
            "In voluptate velit esse cillum dolore.",
            "Eu fugiat nulla pariatur lorem ipsum."
        ];


        foreach ($users as $sender) {
            foreach ($users as $receiver) {
                if ($sender->id !== $receiver->id) {

                    $messageCount = rand(3, 7);

                    for ($i = 0; $i < $messageCount; $i++) {
                        Message::create([
                            'sender_id' => $sender->id,
                            'receiver_id' => $receiver->id,
                            'message' => $sampleMessages[array_rand($sampleMessages)],
                            'created_at' => now()->subMinutes(rand(1, 500)),
                            'updated_at' => now()
                        ]);
                    }
                }
            }
        }
    }
}
