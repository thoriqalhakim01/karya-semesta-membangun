<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\HasTransactions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes, HasTransactions;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            $user->detail()->delete();

            $user->programs()->detach();

            $user->investments()->detach();

            $user->memberTransactions()->delete();
        });

        static::forceDeleting(function ($user) {
            $user->detail()->forceDelete();

            $user->memberTransactions()->forceDelete();
        });
    }

    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn(string $name) => Str::of($name)->substr(0, 1))
            ->implode('');
    }

    public function detail()
    {
        return $this->hasOne(UserDetail::class);
    }

    public function family()
    {
        return $this->hasOne(UserFamily::class);
    }

    public function address()
    {
        return $this->hasOne(UserAddress::class);
    }

    public function programs()
    {
        return $this->belongsToMany(Program::class, 'user_programs', 'user_id', 'program_id');
    }

    public function investments()
    {
        return $this->belongsToMany(Investment::class, 'user_investments');
    }

    public function memberTransactions()
    {
        return $this->hasMany(Transaction::class, 'user_id');
    }
}
