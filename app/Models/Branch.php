<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = ['branch'];

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

}
