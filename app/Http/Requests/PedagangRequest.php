<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PedagangRequest extends FormRequest
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
        $rules = [
            'lapak_id' => 'required',
            'nik' => 'required|max:17|min:10',
            'nama' => 'required',
            'alamat' => 'required',
            'foto' => 'image|mimes:png,jpg,gif',
        ];

        // jika request store/POST
        if ($this->getMethod() == "POST") {
            //tambahkan array rules
            $rules += ['nik' => 'required|max:17|min:10|unique:pedagangs,nik'];
        }

        return $rules;
    }
}
