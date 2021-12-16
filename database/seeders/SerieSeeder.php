<?php

namespace Database\Seeders;

use App\Models\Serie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class SerieSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $json = File::get("database/data/marathon21_series.json");
        $data = json_decode($json);
        foreach ($data as $elt) {
            Serie::create([
                "id" => $elt->id,
                "nom" => $elt->nom,
                "resume" => $elt->resume,
                "langue" => $elt->langue,
                "note" => $elt->note,
                "statut" => $elt->statut,
                "premiere" => $elt->premiere,
                "genre" => $elt->genre,
                "urlImage" => $elt->urlImage,
                "avis" => $elt->avis,
                "urlAvis" => $elt->urlAvis,
            ]);
        }
    }
}
