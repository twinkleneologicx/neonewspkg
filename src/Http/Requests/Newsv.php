<?php

namespace Neologicx\Newspkg\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Newsv extends FormRequest
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
        // dd('hello');
        return [
            'ncat_id'=>'required',
            'image'=>'required|mimes:jpeg,jpg,png,gif,pdf|max:2048',
            'heading'=>'required',
            'news_date'=>'required',
            'end_date'=>'required'
        ];
    }
}
