<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'title', 'description', 'requirements', 
        'location', 'salary', 'deadline', 'status'
    ];
    protected $dates = ['deadline'];

    protected $casts = [
        'deadline' => 'date',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeActive($query)
    {
        return $query->approved()
            ->where('deadline', '>=', now());
    }
}
