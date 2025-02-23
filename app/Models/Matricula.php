<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;
    protected $table = 'matriculas';

    public function getKeyName(){
        return "id";
    }

    public $fillable = [
        'id',
        'estudiante',
        'modulo',
        'created_at',
        'updated_at'
    ];
}
