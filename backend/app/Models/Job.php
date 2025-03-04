<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $fillable = ['company_id', 'title', 'description', 'location', 'job_type', 'deadline'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Relasi: Job memiliki banyak aplikasi/lamaran
    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
