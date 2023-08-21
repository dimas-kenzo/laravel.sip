<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    // kode di bawah berfungsi untuk menyimpan semua kolom
    // yg didefinisakan pada database
    protected $fillable = ['nip','name','email','nik','birth-place','birth-date','gender','phone-number','position','status','address','work-experience','years-of-experience','photo','cv','supporting-documents','last-diploma','transcript',];
}
