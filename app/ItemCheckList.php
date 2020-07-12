<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemCheckList extends Model
{
    protected $fillable = [
        'name', 'done',
    ];

    public function checkList()
    {
    	return $this->belongsTo(CheckList::class, 'item_check_list_id');
    }

}
