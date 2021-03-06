<?php

namespace Tecnoparque;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LineaTecnologica extends Model
{
    use SoftDeletes;

    protected $table = "linea_tecnologicas";
    protected $primaryKey = "idLineaTecnologica";  //se agrega si el nombre de pk no es id
    protected $fillable = ['nombre'];
    protected $dates = ['deleted_at']; //para deshabilitar el registro

    //Una lineaTecnologica tiene muchos gestores
     public function gestors()
    {
        return $this->hasMany('Tecnoparque\Gestor','idGestor','idLineaTecnologica');
    }

}
