<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banprotokoll extends Model
{
    protected $fillable = ['forumname', 'supportfallid', 'supporter', 'spieler', 'von', 'bis'];
}
