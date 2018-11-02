<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserUpdateRequest extends FormRequest
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
          'name' => 'required|max:225',
          'email' => 'required|email|unique:users',
          'password' => 'required|min:3',
        ];
    }

    protected function failedValidation(Validator $validator){
      throw new HttpResponseException(
        response()->json([
          'status' => 1,
          'data' => $validator->errors()->all(),
          'msg' => 'Erro de validação só nao sei porque'
        ], 422)
      );
      // throw new \Error('erro que eu estou a dizer');
    }

    public function messages(){
      return[
        'name.required' => 'Nome é necessario',
        'email.required' => 'Email é necessario',
        'password.required' => 'Password é necessaria'
      ];
    }
}
