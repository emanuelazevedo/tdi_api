<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CommentCreateRequest extends FormRequest
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
          'commentText' => 'required|max:225',
          'article_id' => 'required',
          // 'image' => 'nullable|string',
          'user_id' => 'required'
        ];
    }

    protected function failedValidation(Validator $validator){
     throw new HttpResponseException(
       response()->json([
         'status' => 1,
         'data' => $validator->errors()->all(),
         'msg' => 'Erro de validação'
       ], 422)
     );
       // throw new \Error('erro que eu estou a dizer');
    }

    public function messages(){
     return[
       'commentText.required' => 'Comentário é necessario',
       'article_id.required' => 'É necessário que o comentario tenha um artigo associado',
       'user_id.required' => 'É necessário que o comentario tenha um utilizador associado'
     ];
    }
}
