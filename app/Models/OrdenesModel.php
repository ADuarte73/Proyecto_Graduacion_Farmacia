<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenesModel extends Model
{
    use HasFactory;
    protected $table        = 'ordenes';
    protected $primaryKey   = 'id';
}
