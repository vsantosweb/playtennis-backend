<?php

namespace App\Models\Ebook;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class EbookDowload extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'ebook_id',
        'accepted_terms',
        'email',
    ];

    protected $table = 'ebook_downloads';

    public function ebook()
    {
        return $this->belongsTo(Ebook::class, 'ebook_id');
    }
}
