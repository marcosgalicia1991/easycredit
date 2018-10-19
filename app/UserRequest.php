<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRequest extends Model
{
    use SoftDeletes;

    protected $table = "user_requests";

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'request_id',
        'user_id',
        'status',
    ];

    public function request()
    {
        return $this->belongsTo('App\Request', 'request_id');
    }
}
