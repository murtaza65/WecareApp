<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'community_user');
    }

    const default_community = "My Community";

    public function createDefaultCommunity()
    {
        $community = [
            'name'        => "My Community",
            'description' => "Default community to add members",
            'created_by'  => auth()->id(),
            'status'      => 'active'];
        self::create($community);
    }
}
