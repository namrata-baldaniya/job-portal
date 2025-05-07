<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\JobPost;
use Illuminate\Support\Facades\Auth;
use Lab404\Impersonate\Models\Impersonate;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    /**
 * @method void impersonate(\Illuminate\Foundation\Auth\User $user)
 * @method void stopImpersonating()
 */
    use HasFactory, Notifiable,Impersonate;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function companyProfile()
    {
        return $this->hasOne(CompanyProfile::class);
    }

    public function jobPosts()
    {
        return $this->hasMany(JobPost::class);
    }
    

    public function resume()
    {
        return $this->hasOne(Resume::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isEmployer()
    {
        return $this->role === 'employer';
    }

    public function isJobSeeker()
    {
        return $this->role === 'jobseeker';
    }
    public function impersonate(User $user)
    {
        session(['impersonate' => $user->id]);
        Auth::login($user);
    }

    public function stopImpersonating()
    {
        session()->forget('impersonate');
        Auth::loginUsingId(Auth::user()->id);
    }

    public function isImpersonating()
    {
        return session()->has('impersonate');
    }
}
