<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'job_title',
        'status',
        'applied_date',
        'notes',
        'job_link',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
