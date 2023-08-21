<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testing extends Model
{
    use HasFactory;
    protected $fillable = ['nip','name','email','birthPlace','birthDate','gender','address','workExperience'];

    protected $casts = [
        'workExperience' => 'json'
    ];
}
