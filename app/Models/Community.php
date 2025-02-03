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

    const DEFAULT_COMMUNITY = "My Community";

    public static function createDefaultCommunity()
    {
        $community = [
            'name'        => self::DEFAULT_COMMUNITY,
            'description' => "Default community to add members",
            'created_by'  => auth()->id(),
            'status'      => 'active'];
        self::create($community);
    }
}
