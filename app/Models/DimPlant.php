<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PlantImage;

class DimPlant extends Model
{
    use HasFactory;
    
    protected $table = 'dim_plant'; // Nama tabel
    protected $primaryKey = 'Plant_ID'; // Primary Key

    public $timestamps = false;

    protected $fillable = [
        'Plant_Name',
        'Type_ID',
        'Price',
        'Stock',
    ];

    protected $guarded = ['Plant_Slug']; // Pastikan Plant_Slug tidak dapat diisi secara langsung
    
    public static function getProductsWithImages()
    {
        return \App\Models\DimPlant::with('image')->get();
    }


    public function type()
    {
        return $this->belongsTo(Catalog::class, 'Type_ID', 'Type_ID');
    }

    public function image()
    {
        return $this->hasMany(PlantImage::class, 'Plant_ID', 'Plant_ID');
    }

    public function getPricelabelAttribute()
    {
        return number_format($this->Price);
    }

}