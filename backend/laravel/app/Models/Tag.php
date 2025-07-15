<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    //Relationship with the note model -> one tag belongs to many Notes -> many-to-many
    public function notes(): BelongsToMany {
        return $this->belongsToMany(Note::class);
    }
}
