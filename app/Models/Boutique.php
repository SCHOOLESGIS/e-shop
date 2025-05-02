<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Boutique extends Model
{
    /** @use HasFactory<\Database\Factories\BoutiqueFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'logo',
        'description'
    ];

    public function user () : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function produits () : HasMany
    {
        return $this->hasMany(Produit::class, 'boutique_id', 'id');
    }
}
