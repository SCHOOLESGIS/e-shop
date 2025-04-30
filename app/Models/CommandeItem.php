<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommandeItem extends Model
{
    /** @use HasFactory<\Database\Factories\CommandeItemFactory> */
    use HasFactory;

    protected $fillable = [
        'quantity',
        'unit_price'
    ];

    public function commande () : BelongsTo
    {
        return $this->belongsTo(Commande::class, 'commande_id', 'id');
    }

    public function produit () : BelongsTo
    {
        return $this->belongsTo(Produit::class, 'produit_id', 'id');
    }
}
