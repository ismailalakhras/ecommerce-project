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

        $groupNames = ['Laravel', 'Php', 'Javascript', 'SQL'];

        foreach ($groupNames as $groupName) {

         
            $group = GroupChat::firstOrCreate(['name' => $groupName]);

        
            $userIds = $users->pluck('id')->random(5)->toArray();
            $group->users()->syncWithoutDetaching($userIds); 

            
            foreach (range(1, 10) as $i) {
                GroupMessage::create([
                    'group_chat_id' => $group->id,
                    'sender_id' => $group->users()->inRandomOrder()->first()->id,
                    'message' => fake()->sentence(),
                ]);
            }
        }
    }
}
