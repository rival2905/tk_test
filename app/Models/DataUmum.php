<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUmum extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    protected $casts = [
        'is_active' => 'boolean',
        'id' => 'string'
    ];

    public function duDc()
{
    return $this->hasMany(\App\Models\DataUmumDocumentCategory::class, 'data_umum_id', 'id');
}


}
