<?php namespace Modules\Production\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    protected $fillable = [
        'user_id',
        'buyer_id',
        'style_id',
        'order_date',
        'delivery_date',
        'gg',
        'qty',
        'fob',
        'weight_per_dzn',
        'total_yarn_weight',
        'qty_per_dzn',
        'total_yarn_weight',
        'total_yarn_cost',
        'acc_rate',
        'total_acc_cost',
        'btn_cost',
        'total_btn_cost',
        'zipper_cost',
        'total_zipper_cost',
        'print_cost',
        'total_print_cost',
        'total_fob',
        'total_cost',
        'balance_amount',
        'cost_of_making',
        'compositions',
    ];

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