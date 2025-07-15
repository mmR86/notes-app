<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Note extends Model
{
    use HasFactory;


    //Relationship with the User, Note belongs to User
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    //Relationship with the Category, Note belongs to Category
    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }

    //Relationship with the Tags, one Note belongs to many tags -> many-to-many
    public function tags(): BelongsToMany {
        return $this->belongsToMany(Tag::class);
    }
}
