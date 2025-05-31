<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserFamily extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_families';

    protected $fillable = [
        'user_id',
        'father_name',
        'mother_name',
        'family_status',
        'number_of_children',
        'residential_ownership',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
