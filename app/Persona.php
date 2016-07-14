<?php

namespace Tecnoparque;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
	use SoftDeletes;

	protected $table = "personas";
	protected $primaryKey = "idPersona";  //se agrega si el nombre de pk no es id
	protected $fillable = ['numeroIdentificacion','nombres','apellidos','genero','telefono','celular','correo','empresa','idTipoDocumento','idTipoPersona']; //estado bit...mirar si agregar o no
	protected $dates = ['deleted_at'];  //para deshabilitar el registro

	//Una persona tiene un tipoDocumento
    public function tipoDocumentos()
    {
        return $this->belongsTo('Tecnoparque\TipoDocumento','idTipoDocumento');
    }

    //Una persona tiene un tipoPersona
    public function tipoPersonas()
    {
        return $this->belongsTo('Tecnoparque\TipoPersona','idTipoPersona');
    }
}
