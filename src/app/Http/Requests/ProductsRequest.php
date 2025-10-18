<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
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
            'name'=>'required', 
            'price'=>'required|integer|between:0,10000', 
            'image'=>'required|image|mimes:jpg,png', 
            'season'=>'required',
            'text'=>'required|max:120'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'商品名を入力してください', 
            'price.integer'=>'数値で入力してください',
            'price.between'=>'0~10000円以内で入力してください', 
            'season.required'=>'季節を選択してください', 
            'text.required'=>'商品説明を入力してください', 
            'text.max'=>'120文字以内で入力してください', 
            'image.required'=>'商品画像を登録してください',
            'image.mimes:jpg,png'=>'「.png」または「.jpeg」形式でアップロードしてください',
        ];
    }
}
