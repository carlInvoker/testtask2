<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\ClientFactory;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'adress',
        'company_id',
    ];

    public function company()
    {
       return $this->belongsTo(Company::class);
    }

    protected static function newFactory()
    {
      return ClientFactory::new();
    }

}
