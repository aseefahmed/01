<?php namespace Modules\Production\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    protected $fillable = [];

    public function buyer_details()
    {
        return $this->belongsTo('Modules\Production\Entities\Buyer');
    }

}