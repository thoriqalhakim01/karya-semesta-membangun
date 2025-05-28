<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $table = 'user_details';

    protected $fillable = [
        'user_id',
        'birth_place',
        'birth_date',
        'gender',
        'is_married',
        'last_education',
        'major',
        'job',
        'bank_accounts',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
