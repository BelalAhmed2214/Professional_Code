<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name_en' => 'required|min:2|unique:offers,name_en',
            'name_ar' => 'required|min:2|unique:offers,name_ar',
            
            'price' => 'required|numeric' 
        ];
    }
    public function messages()
    {
        return [
            'name_en.required' =>with(__('messages.offer name_en is required')),
            'name_ar.required' =>with(__('messages.offer name_ar is required')),
            
            'name_en.unique' =>with(__('messages.offer name_en already token')),
            'name_en.min'=>with(__('messages.offer name_en minimum length is 2 character')),
            'name_ar.unique' =>with(__('messages.offer name_ar already token')),
            'name_ar.min'=>with(__('messages.offer name_ar minimum length is 2 character')),
            
            'price.required'=>with(__('messages.offer price is required')),
            'price.numeric' =>with(__('messages.offer price must be numeric')), 
        ];
    }
}
