<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SemanticCore extends Model
{
    use HasFactory;

    public function seokeys()
    {
        return $this->hasMany(SemanticCoreKey::class)->where("type","=","1");
    }

    public function seoKeysCount()
    {
        return $this->hasMany(SemanticCoreKey::class)->where("type","=","1")->count();
    }

}
