<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DimCustomer extends Model
{
    use HasFactory;

    protected $table = 'dim_customer';
    protected $primaryKey = 'Customer_ID';
    public $timestamps = false; // Jika tabel tidak memiliki created_at dan updated_at

    protected $fillable = [
        'Name', 'Location', 'Age', 'Gender'
    ];
}