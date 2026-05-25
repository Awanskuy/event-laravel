<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'date',
        'location',
        'price',
        'quota',
        'image',
        'category',
    ];

    protected $casts = [
        'date' => 'datetime',
        'price' => 'decimal:2',
    ];

    /**
     * Resolve the display image: the uploaded poster if present, otherwise a
     * curated default photo based on the event category. Guarantees every
     * event always has a relevant, attractive image.
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }

        $category = in_array($this->category, ['music', 'tech', 'art', 'food'], true)
            ? $this->category
            : 'default';

        return asset('images/categories/' . $category . '.jpg');
    }

    /**
     * Indonesian display label for the category (the stored value stays the
     * English key used for filtering: music/tech/art/food).
     */
    public function getCategoryLabelAttribute(): string
    {
        return [
            'music' => 'Musik',
            'tech' => 'Teknologi',
            'art' => 'Seni',
            'food' => 'Kuliner',
        ][$this->category] ?? ucfirst((string) $this->category);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
