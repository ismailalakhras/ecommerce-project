<?php

namespace Database\Seeders;

use App\Models\GroupChat;
use App\Models\GroupMessage;
use App\Models\User;
use Illuminate\Database\Seeder;

class GroupChatSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        $group = GroupChat::create([
            'name' => 'Group 1',
            'name' => 'Group 2',
            'name' => 'Group 3',
            'name' => 'Group 4',
        ]);

        $group->users()->attach($users->pluck('id')->random(5));

        foreach (range(1, 10) as $i) {
            GroupMessage::create([
                'group_chat_id' => $group->id,
                'sender_id' => $group->users->random()->id,
                'message' => fake()->sentence(),
            ]);
        }
    }
}
