<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProgram extends Model
{
    use HasFactory;

    protected $table = 'user_programs';

    protected $fillable = [
        'user_id',
        'program_id',
        'join_date',
    ];
}
