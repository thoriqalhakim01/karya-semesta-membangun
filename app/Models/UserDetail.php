<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDetail extends Model
{
    use HasFactory, SoftDeletes;

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
        'btn_account_number',
        'mandiri_account_number',
    ];

    protected $casts = [
        'bank_accounts' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
