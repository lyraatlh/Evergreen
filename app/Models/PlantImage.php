<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantImage extends Model
{
    use HasFactory;

    protected $table = 'plant_images'; // Nama tabel
    protected $primaryKey = 'id'; // Primary key

    protected $fillable = [
        'Plant_ID',
        'image_url',
    ];

    public function plant()
    {
        return $this->belongsTo(DimPlant::class, 'Plant_ID', 'Plant_ID');
    }
}