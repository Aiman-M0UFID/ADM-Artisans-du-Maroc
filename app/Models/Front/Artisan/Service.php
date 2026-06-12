<?php

namespace App\Models\Front\Artisan;

use App\Models\Front\Admin\Categorie;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'title',
        'experience',
        'image',
        'details',
        'user_id',
        'categorie_id'
    ];

    /**
     * Get all of the Categorie for the Service
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Categorie()
    {
        return $this->hasMany(Categorie::class, 'categorie_id');
    }

     /**
     * Get all of the users for the Service
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
