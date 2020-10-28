<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipeSaveRequest extends FormRequest
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
            "title"       => ["required", "min:3", "max:64"],
            "description" => ["required", "min:3", "max:512"],
            "image"       => ["file", "image", "mimes:jpeg,png", "max:14336"],
        ];
    }

    /**
     * 
     */
    public function messages(){
        return [
            'title.required'  => 'レシピのタイトルは必須項目です。',
            'title.min'       => 'タイトルは3文字以上で入力してください。',
            'title.max'       => 'タイトルは64文字以下で入力してください',

            'description.required' => '説明文は必須項目です。',
            'description.min'      => '説明文は3文字以上で入力してください。',
            'description.max'      => '説明文は512文字以下で入力してください',

            "image.file"  => "ファイルのアップロードに失敗しました",
            "image.image" => "画像以外のファイルはアップロードできません",
            "image.mimes" => "ファイルの種類を確認してください",
            "image.max"   => "対応しているファイルのサイズは約14MBまでです"

        ];
    }

}
