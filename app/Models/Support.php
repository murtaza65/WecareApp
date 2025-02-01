<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    /** @use HasFactory<\Database\Factories\ReminderFactory> */
    use HasFactory;

    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function goals()
    {
        return $this->belongsTo(Goal::class);
    }

}
