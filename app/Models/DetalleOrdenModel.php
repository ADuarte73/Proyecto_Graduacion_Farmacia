<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleOrdenModel extends Model
{
    use HasFactory;
    protected $table        = 'detalleorden';
    protected $primaryKey   = 'id';
}
