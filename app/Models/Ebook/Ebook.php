<?php

namespace App\Models\Ebook;

use App\Models\Workout\Workout;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ebook extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'slug',
        'is_main',
        'url',
        'download_total',
    ];

    static function booted()
    {
        parent::creating(fn (Ebook $ebook) => [$ebook->uuid = Str::uuid(), $ebook->slug = 'ebook-' . Str::slug($ebook->name)]);
        parent::updating(fn (Ebook $ebook) => $ebook->slug = 'ebook-' . Str::slug($ebook->name));
    }

    public function workout()
    {
        return $this->belongsTo(Workout::class, 'slug');
    }

    public function downloads()
    {
        return $this->hasMany(EbookDowload::class);
    }
}
