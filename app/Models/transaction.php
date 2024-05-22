<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    protected $table = "transaction";
    protected $primaryKey = "id";
    use HasFactory;
}
