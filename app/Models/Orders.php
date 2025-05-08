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
        'Customer_ID', 'Plant_Name', 'Quantity', 'total_price'
    ];

    public function plant()
    {
        return $this->belongsTo(DimPlant::class, 'Plant_Name');
    }

    public function customer()
    {
        return $this->belongsTo(DimCustomer::class, 'Customer_ID');
    }
}