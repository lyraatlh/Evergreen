<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    use HasFactory;

    protected $table = 'plant_type'; // Nama tabel
    protected $primaryKey = 'Type_ID'; // Primary Key

    public $timestamps = false;

    protected $fillable = [
        'Type_Name',
    ];

    public function plants()
    {
        return $this->hasMany(DimPlant::class, 'Type_ID', 'Type_ID');
    }

    // Relasi ke kategori tanaman melalui tabel pivot `Plant_Type`
    public function categories()
    {
        return $this->belongsToMany(
            Catalog::class, 
            'Plant_Type', 
            'Type_ID', 
            'Category_ID'
        )->withPivot('Type_ID', 'Category_ID'); // Pastikan pivot sudah benar
    }
}
