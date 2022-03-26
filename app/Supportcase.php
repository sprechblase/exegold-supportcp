<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supportcase extends Model
{
    protected $fillable = ['type', 'casetype', 'supporter', 'spieler', 'scn', 'geschehen', 'Beweise', 'Entscheidung', 'done'];
}
