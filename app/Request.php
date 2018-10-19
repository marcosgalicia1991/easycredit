<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $table = "requests";

    protected $fillable = [
        'age',
        'amount',
        'credit_card',
        'term_id',
        'total_amount',
    ];

    //relacion con tabla user_requests
    public function userRequest()
    {
        return $this->hasOne('App\userRequest', 'request_id');
    }

    //relacion con tabla option_terms
    public function term()
    {
    	return $this->hasOne('App\OptionTerm', 'id', 'term_id');
    }
}
