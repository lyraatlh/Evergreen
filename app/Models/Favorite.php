<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $table = 'favorites';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'Customer_ID', 'Plant_ID'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plant()
    {
        return $this->belongsTo(DimPlant::class, 'Plant_ID', 'Plant_ID');
    }
}