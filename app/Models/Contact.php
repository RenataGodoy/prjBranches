<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    // Defina os campos que podem ser preenchidos em massa
    protected $fillable = ['name', 'departament', 'local', 'branch_id_1', 'branch_id_2']; // Atualizado para incluir branch_id_1 e branch_id_2

    // Relacionamento com o primeiro ramal
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id_1');
    }

    // Relacionamento com o segundo ramal
    public function secondBranch() // Atualizado para o segundo ramal
    {
        return $this->belongsTo(Branch::class, 'branch_id_2');
    }
}
