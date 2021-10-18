<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenReferenciaModel extends Model
{
    use HasFactory;
    protected $table        = 'imagen_referencia';
    protected $primaryKey   = 'id';
}
