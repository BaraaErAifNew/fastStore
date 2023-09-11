<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetail extends Model
{
    use HasFactory;

    protected $casts = [
        'price' => 'float',
        'discount_on_item' => 'float',
        'total_add_on_price' => 'float',
        'tax_amount' => 'float',
        'item_id' => 'integer',
        'order_id' => 'integer',
        'quantity' => 'integer',
        'item_campaign_id' => 'integer',
//        'item_details' => 'json',
    ];

    protected $primaryKey = 'id';

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class,'store_id');
    }

    public function vendor()
    {
        return $this->order->store();
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function campaign()
    {
        return $this->belongsTo(ItemCampaign::class, 'item_campaign_id');
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->Has('order');
        });
    }
}
