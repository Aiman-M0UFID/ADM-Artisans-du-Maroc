<?php

namespace App\Models\Front\Admin;

use App\Models\Front\Artisan\Service;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'sub_title',
        'image'
    ];

     /**
     * Get all of the service for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function service()
    {
        return $this->belongsTo(Service::class,'categorie_id');
    }
}
