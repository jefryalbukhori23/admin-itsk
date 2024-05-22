<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class berkas_pendaftaran_mahasiswa extends Model
{
    protected $table = "berkas_pendaftaran_mahasiswa";
    protected $primaryKey = "id";
    use HasFactory;
}
