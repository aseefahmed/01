<?php namespace Modules\Production\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class Buyer extends Model {

    protected $fillable = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}