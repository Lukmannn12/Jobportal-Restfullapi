<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'job_id',
        'cover_letter',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Satu aplikasi dibuat untuk satu job
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

}
