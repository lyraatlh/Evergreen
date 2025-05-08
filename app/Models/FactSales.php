<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactSales extends Model
{
    use HasFactory;

    protected $table = 'fact_sales';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'Transaction_ID', 'Customer_ID', 'Plant_ID', 'Time_ID', 'Supplier_ID', 'Quantity', 'Total_Payment'
    ];

    public function customer()
    {
        return $this->belongsTo(DimCustomer::class, 'Customer_ID');
    }

    public function supplier()
    {
        return $this->belongsTo(DimSupplier::class, 'Supplier_ID');
    }

    public function product()
    {
        return $this->belongsTo(DimPlant::class, 'Plant_ID');
    }
}