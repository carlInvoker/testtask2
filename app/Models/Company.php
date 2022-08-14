<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\CompanyFactory;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'adress',
        'description',
    ];

    public function client()
    {
       return $this->hasMany(Client::class);
    }

    protected static function newFactory()
    {
      return CompanyFactory::new();
    }
}
