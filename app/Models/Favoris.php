<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favoris extends Model
{
    use SoftDeletes;

    public function user () : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function produit () : BelongsTo
    {
        return $this->belongsTo(Produit::class, 'user_id', 'id');
    }
}
