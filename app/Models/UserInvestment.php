<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserInvestment extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'user_investments';

    protected $fillable = [
        'user_id',
        'investment_id',
        'join_date',
    ];
}
