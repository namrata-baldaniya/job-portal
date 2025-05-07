<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    protected $fillable = [
        'user_id', 'title', 'description', 'requirements', 
        'location', 'salary', 'deadline', 'status'
    ];
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
}
