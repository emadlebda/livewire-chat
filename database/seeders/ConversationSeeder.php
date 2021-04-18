<?php

namespace Database\Seeders;

use App\Models\Conversation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ConversationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Conversation::create(['name' => 'Family group', 'uuid' => Str::uuid(), 'user_id' => 1]);
        Conversation::create(['name' => 'Work group', 'uuid' => Str::uuid(), 'user_id' => rand(1, 4)]);
        Conversation::create(['name' => 'Friends group', 'uuid' => Str::uuid(), 'user_id' => rand(1, 4)]);
        Conversation::create(['name' => 'Guys group', 'uuid' => Str::uuid(), 'user_id' => rand(1, 4)]);
        Conversation::create(['name' => 'Art group', 'uuid' => Str::uuid(), 'user_id' => rand(1, 4)]);

        DB::table('conversation_user')->insert(['conversation_id' => 1, 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('conversation_user')->insert(['conversation_id' => 1, 'user_id' => 2, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('conversation_user')->insert(['conversation_id' => 1, 'user_id' => 3, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('conversation_user')->insert(['conversation_id' => 1, 'user_id' => 4, 'created_at' => now(), 'updated_at' => now()]);

        DB::table('conversation_user')->insert(['conversation_id' => 2, 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('conversation_user')->insert(['conversation_id' => 2, 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()]);

        DB::table('conversation_user')->insert(['conversation_id' => 3, 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('conversation_user')->insert(['conversation_id' => 3, 'user_id' => 3, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('conversation_user')->insert(['conversation_id' => 3, 'user_id' => 4, 'created_at' => now(), 'updated_at' => now()]);

        DB::table('conversation_user')->insert(['conversation_id' => 4, 'user_id' => 2, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('conversation_user')->insert(['conversation_id' => 4, 'user_id' => 3, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('conversation_user')->insert(['conversation_id' => 4, 'user_id' => 4, 'created_at' => now(), 'updated_at' => now()]);

        DB::table('conversation_user')->insert(['conversation_id' => 5, 'user_id' => 3, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('conversation_user')->insert(['conversation_id' => 5, 'user_id' => 4, 'created_at' => now(), 'updated_at' => now()]);
    }
}
