<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    //Relationship with the note model -> one Category can have many Notes
    public function notes():HasMany {
        return $this->hasMany(Note::class);
    }
}
