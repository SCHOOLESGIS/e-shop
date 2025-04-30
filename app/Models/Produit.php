<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produit extends Model
{
    /** @use HasFactory<\Database\Factories\ProduitFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'stock'
    ];

    public function boutique () : BelongsTo
    {
        return $this->belongsTo(Boutique::class, 'boutique_id', 'id');
    }

    public function categorie () : BelongsTo
    {
        return $this->belongsTo(Categorie::class, 'categorie_id', 'id');
    }
}
