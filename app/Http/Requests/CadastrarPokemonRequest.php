<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Str;

class CadastrarPokemonRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        $this->merge([
            'nome' => Str::ucfirst(Str::lower($this->nome)),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => 'required|unique:pokemon|max:255',
            'tipo' => 'required',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(0));
    }

    public function messages()
    {
        return [
            'nome.required' => 'Nome é obrigatório',
            'nome.unique' => 'Nome já existe',
            'tipo.required' => 'Tipo é obrigatório',
        ];
    }
}
