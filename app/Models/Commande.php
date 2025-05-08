<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Commande extends Model
{
    /** @use HasFactory<\Database\Factories\CommandeFactory> */
    use HasFactory;

    protected $fillable = [
        'total',
        'status'
    ];

    public function user () : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function boutique () : BelongsTo
    {
        return $this->belongsTo(Boutique::class, 'boutique_id', 'id');
    }

    public function commandeItems () : HasMany
    {
        return $this->hasMany(CommandeItem::class, 'commande_id', 'id');
    }
}
