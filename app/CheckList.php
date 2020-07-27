<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckList extends Model
{
	protected $fillable = [
        'name', 'slug', 'user_id',
    ];

    public function itemCheckLists()
    {
    	return $this->hasMany(ItemCheckList::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
