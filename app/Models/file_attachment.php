<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class file_attachment extends Model
{
    protected $table = "file_attachment";
    protected $primaryKey = "id";
    use HasFactory;
}
