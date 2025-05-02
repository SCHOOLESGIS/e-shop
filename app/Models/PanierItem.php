<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PanierItem extends Model
{
    /** @use HasFactory<\Database\Factories\PanierItemFactory> */
    use HasFactory;

    protected $fillable = [
        'produit_id',
        'quantity'
    ];

    public function panier () : BelongsTo
    {
        return $this->belongsTo(Panier::class, 'panier_id', 'id');
    }

    public function produit () : BelongsTo
    {
        return $this->belongsTo(Produit::class, 'produit_id', 'id');
    }
}
