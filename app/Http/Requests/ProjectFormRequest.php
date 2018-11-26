<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectFormRequest extends FormRequest
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
            'name'=> 'required|min:3',
            //'state_id'=> 'required',
            //'city_id'=> 'required',
            //'neighborhood_id'=> 'required',
            //'modality_id'=> 'required',
            //'enviroment'=> 'required',
            //'native'=> 'required',
            'description'=> 'required',
            'goals'=> 'required',
            'objectives'=> 'required',
            'number_of_households'=> 'required',

            //'cta_cte_ctral'=> 'required',

            //'owner'=> 'required',
            'value'=> 'required',
            //'number_of_beneficiaries'=> 'required',

            'level1'=> 'required',
            'level2'=> 'required',
            'level3'=> 'required',
            'level4'=> 'required',


        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo Descripción es Requerido',
            'description.required' => 'El campo Descripción es Requerido',
            'goals.required' => 'El campo Objetivos es Requerido',
            'number_of_households.required'  => 'El campo Cantidad de Viviendas es Requerido',
            'objectives.required' => 'El campo Resultados es Requerido',
            'value.required'  => 'El campo Valor Ofertado es Requerido',

            'level1.required' => 'El campo Nivel 1 es Requerido',
            'level2.required' => 'El campo Nivel 2 es Requerido',
            'level3.required' => 'El campo Nivel 3 es Requerido',
            'level4.required' => 'El campo Nivel 4 es Requerido',
        ];
    }
}
