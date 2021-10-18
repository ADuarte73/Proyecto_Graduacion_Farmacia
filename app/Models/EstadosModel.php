<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadosModel extends Model
{
    use HasFactory;
    protected $table      = 'estados';
    protected $primaryKey = 'id';
}
