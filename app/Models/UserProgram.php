<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserProgram extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_programs';

    protected $fillable = [
        'user_id',
        'program_id',
        'join_date',
    ];
}
