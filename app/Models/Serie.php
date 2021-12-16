<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model {
    use HasFactory;

    protected $fillable = [
        "id",
        "nom",
        "resume",
        "langue",
        "note",
        "statut",
        "premiere",
        "genre",
        "urlImage",
        "avis",
        "urlAvis",
    ];

    public $timestamps = false;

    // A serie has many episodes
    public function episodes() {
        return $this->hasMany(Episode::class, "serie_id");
    }

    // A serie has many comments
    public function comments() {
        return $this->hasMany(Comment::class, "serie_id");
    }

}
