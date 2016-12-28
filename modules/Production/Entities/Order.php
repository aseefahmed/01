<?php namespace Modules\Production\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model {
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [];

    public function buyer()
    {
        return $this->belongsTo('Modules\Production\Entities\Buyer');
    }

    public function style()
    {
        return $this->belongsTo('Modules\Production\Entities\Style');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}