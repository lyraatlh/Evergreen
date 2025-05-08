<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DimSupplier extends Model
{
    use HasFactory;

    protected $table = 'dim_supplier';
    protected $primaryKey = 'Supplier_ID';
    public $timestamps = false;

    protected $fillable = [
        'Supplier_Name', 'City', 'Contact'
    ];
}