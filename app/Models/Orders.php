<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'Customer_ID', 'Plant_ID', 'Quantity', 'total_price'
    ];

    public function plant()
    {
        return $this->belongsTo(DimPlant::class, 'Plant_ID');
    }

    public function customer()
    {
        return $this->belongsTo(DimCustomer::class, 'Customer_ID');
    }
}