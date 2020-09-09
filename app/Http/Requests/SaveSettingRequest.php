<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveSettingRequest extends FormRequest
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
            'type' => 'required|string',
            'value_utc' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (strlen($value) < 5 || strlen($value) > 5) {
                        $fail('Wrong Time all');
                    }
                    $arrayValue = str_split($value);
                    if (!is_numeric($arrayValue[0]) || !is_numeric($arrayValue[1]) || !is_numeric($arrayValue[3]) || !is_numeric($arrayValue[4])) {
                        $fail('Wrong Time');
                    }
                    if ($arrayValue[0] > 2 || $arrayValue[0] < 0) {
                        $fail('Wrong Time');
                    }

                    if ($arrayValue[1] < 0 || $arrayValue[1] > 9) {
                        $fail('Wrong Time');
                    }

                    if ($arrayValue[2] != ':') {
                        $fail('Wrong Time');
                    }
                    if ($arrayValue[3] < 0 || $arrayValue[3] > 5) {
                        $fail('Wrong Time');
                    }
                    if ($arrayValue[4] < 0 || $arrayValue[4] > 9) {
                        $fail('Wrong Time');
                    }

                }

            ]
        ];
    }

}
