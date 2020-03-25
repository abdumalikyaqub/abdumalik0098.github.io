<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	use SoftDeletes;
    protected $dates=['deleted_at'];

    protected $fillable = [
        'id', 'text', 'title', 'created_at'
    ];

    public function users()
    {
        return $this->belongsToMany('App\User', 'article_user')->withTimestamps();
    }

    public function isAuthor($user)
    {
        if (!$user) {
            return Config::get('constants.mismatch');
        }

        if ($this->trashed()) {
            return null;
        }

        if ($this->users()->find($user->id)) {
            return true;
        } else {
            return false;
        }
    }

}
