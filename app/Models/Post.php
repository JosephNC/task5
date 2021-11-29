<?php

namespace App\Models;

use App\Events\PostCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'description',
        'website_id',
    ];

    /**
     * Get the website that owns the post.
     */
    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public static function boot()
    {
        parent::boot();

        // Dispath event after creation
        self::created(fn ($model) => PostCreated::dispatch($model));
    }
}
