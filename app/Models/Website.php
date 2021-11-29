<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'url'
    ];

    /**
     * Get the posts for the website.
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Get the subscribers for the website.
     */
    public function subscribers()
    {
        return $this->hasMany(Subscriber::class);
    }
}
