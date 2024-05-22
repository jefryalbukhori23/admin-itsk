<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mail_template extends Model
{
    protected $table = "mail_template";
    protected $primaryKey = "id";
    use HasFactory;
}
