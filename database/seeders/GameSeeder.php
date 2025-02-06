<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Game;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $games = [
            ['name'=>'Count the Fruit','description'=>'Let’s count yummy fruits together! Look at the apples, bananas, and oranges, then count them out loud. How many can you find? It’s time to count and have fun!','code'=>'CTF','is_open'=>true,'user_id'=>1],

            ['name'=>'Find the Missing Letter','description'=>'Uh-oh! Some letters are hiding! Can you help find the missing ones? Say the word and pick the right letter to make it complete. You’re a letter detective!','code'=>'FML','is_open'=>true,'user_id'=>1],

            ['name'=>'Name the Shape','description'=>'Triangles, circles, and squares—oh my! Let’s find and name all the shapes we see. Are you ready to be a shape superstar?','code'=>'NTS','is_open'=>true,'user_id'=>1],

            ['name'=>'Name the Color','description'=>'Let’s play with colors! Red, blue, green, and more—can you name the color of everything around? Let’s make the world colorful and fun!','code'=>'NTC','is_open'=>true,'user_id'=>1],

            ['name'=>'Count the Number','description'=>'Numbers are everywhere! Can you count how many stars, blocks, or toys you see? Let’s count together and be number champions!','code'=>'CTN','is_open'=>true,'user_id'=>1],
        ];

        foreach ($games as $game) {
            Game::create($game);
        }
    }
}
