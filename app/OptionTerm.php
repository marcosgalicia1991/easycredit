<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptionTerm extends Model
{
    protected $table = 'option_terms';

    protected $hidden = [
        'created_at',
        'updated_at',
        //'deleted_at',
    ];

    public function request()
    {
        return $this->belongsTo('App\Request', 'term_id');
    }
}
