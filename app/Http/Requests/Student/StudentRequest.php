<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'name' => 'required',
        ];
    }

    public function data()
    {
        $data = [
            'name' => $this->get('name'),
            'email'  => $this->get('email'),
            'phone'  => $this->get('phone'),
            'program'  => $this->get('program'),
            'intake_year'  => $this->get('intake_year'),
            'intake_month'  => $this->get('intake_month'),
        ];

        return $data;

    }
}
