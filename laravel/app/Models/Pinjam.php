<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pinjam extends Model
{
    protected $fillable = ['user_id', 'buku_id', 'tgl_dipinjam', 'tgl_dikembalikan', 'due_date', 'status', 'denda'];

    protected $casts = [
        'tgl_dipinjam' => 'date',
        'tgl_dikembalikan' => 'date',
        'due_date' => 'date',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
    public function buku(): BelongsTo {
        return $this->belongsTo(Buku::class);
    }   
}
