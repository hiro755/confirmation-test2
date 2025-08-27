<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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

public function rules(): array
{
    return [
        'name'        => ['required','string','max:255'],
        'price'       => ['required','numeric'],
        'image'       => ['nullable','image'], // 画像必須なら required|image
        'seasons'     => ['nullable','array'],
        'seasons.*'   => ['in:春,夏,秋,冬'],
        'description' => ['required','string'],
    ];
}

public function messages(): array
{
    return [
        'name.required' => '商品名を入力してください。',
        'price.required' => '値段を入力してください。',
        'price.numeric' => '数値で入力してください。',
        'price.between' => '0〜10000以内で入力してください。',
        'seasons.required' => '季節を選択してください。',
        'description.required' => '商品説明を入力してください。',
        'description.max' => '120文字以内で入力してください。',
        'image.mimes' => '「.png」または「.jpeg」形式でアップロードしてください。',
        'image.required' => '商品画像を登録してください',
    ];
}

public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $price = $this->input('price');

            if (!is_null($price)) {
                if (!is_numeric($price)) {
                    $validator->errors()->add('price', '数値で入力してください。');
                } elseif ($price < 0 || $price > 10000) {
                    $validator->errors()->add('price', '0〜10000以内で入力してください。');
                }
            }
        });
    }
}
