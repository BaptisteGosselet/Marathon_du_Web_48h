<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Episode;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        User::factory(1)->create([
            'name' => 'Robert Duchmol',
            'email' => 'robert.duchmol@domain.fr',
            'administrateur' => 1,
            'avatar' => 'img/face/avatar.png',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
        User::factory(1)->create([
            'name' => 'Gérard Martin',
            'email' => 'gerard.martin@domain.fr',
            'administrateur' => 0,
            'avatar' => 'img/face/avatar1.png',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
        User::factory(1)->create([
            'name' => 'Julia Rodrigez',
            'email' => 'julia.rodrigez@domain.fr',
            'administrateur' => 0,
            'avatar' => 'img/face/avatar2.png',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
        $this->call(SerieSeeder::class);
        $this->call(EpisodeSeeder::class);

      Comment::factory(100)->create();
        $comments = Comment::with('utilisateur','serie')->get();
        foreach ($comments as $comment) {
            $user = User::findOrFail($comment->utilisateur->id);
            $episode = Episode::where('serie_id', $comment->serie->id)->orderBy('numero')->first();
            $user->seen()->attach($episode->id, ['date_seen' => $comment->updated_at]);
        }
    }
}
