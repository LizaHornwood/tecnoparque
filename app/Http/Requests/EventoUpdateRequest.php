<?php

namespace Tecnoparque\Http\Requests;

use Tecnoparque\Http\Requests\Request;

class EventoUpdateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'idServicio' =>'required',
            'nombre' => 'required|max:50',
            'fecha' => 'required',
            'hora' => 'required',
            'lugar' => 'required',
            'cupos' => 'integer|max:100',
            'descripcion'=>'max:100',
        ];
    }
}
