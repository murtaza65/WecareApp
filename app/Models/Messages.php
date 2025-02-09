<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        # code...
        return $this->belongsTo(User::class, 'user_id');
    }
}
