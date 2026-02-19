<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Challenge extends Model
{
    use HasFactory, SoftDeletes;

    // Colonnes autorisées pour l'affectation de masse
    protected $fillable = [
        'title',
        'category',
        'difficulty',
        'price',
        'description',
        'flag_hash',
        'author_id',
        'image_url',
        'is_active',
        'file_path',
        'access_url',
    ];

    // Définir la relation avec l'utilisateur (auteur) (obligatoire pour récupérer les infos de l'auteur !)
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function submissions()
    {
        return $this->hasMany(\App\Models\Submission::class);
    }
}