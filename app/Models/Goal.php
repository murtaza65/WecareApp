<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    /** @use HasFactory<\Database\Factories\GoalsFactory> */
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'comments' => 'array', // Ensure comments are handled as an array
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function progress()
    {
        return $this->hasMany(Progress::class);
    }

    public function reminders()
    {
        return $this->hasMany(Progress::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

}
