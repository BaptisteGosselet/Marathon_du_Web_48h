<?php

namespace Database\Seeders;

use App\Models\Episode;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class EpisodeSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $json = File::get("database/data/marathon21_episodes.json");
        $data = json_decode($json);
        foreach ($data as $elt) {
            Episode::create([
                "id" => $elt->id,
                "nom" => $elt->nom,
                "serie_id" => $elt->serie_id,
                "resume" => $elt->resume,
                "numero" => $elt->numero,
                "saison" => $elt->saison,
                "duree" => $elt->duree,
                "premiere" => $elt->premiere,
                "urlImage" => $elt->urlImage,
            ]);
        }
    }
}
