<?php
namespace App\Models;

use App\HasTransactions;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Investment extends Model
{
    use HasFactory, SoftDeletes, HasTransactions, HasUuids;

    protected $fillable = [
        'name',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            $model->transactions()->delete();
        });

        static::forceDeleting(function ($model) {
            $model->transactions()->forceDelete();
        });
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_investments');
    }
}
