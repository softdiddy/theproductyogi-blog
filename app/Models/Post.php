<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuids;

class Post extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = ['title', 'body', 'user_id']; // Ensure 'user_id' is included

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
