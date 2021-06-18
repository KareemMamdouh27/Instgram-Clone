<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;
    public $fillable = ['description', 'title', 'user_id', 'url', 'image'];

    public function profileImage()
    {
        $imagePath = ($this->image) ?  $this->image : '/profile.jpg';
        return '/storage/' . $imagePath;
    }

    ## Relation With User ##
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    ### Many To Many RelationShip With Users WHo can Follow Profiles###
    public function followers()
    {
        return $this->belongsToMany(User::class);
    }
}
