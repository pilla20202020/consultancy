<?php

namespace App\Http\Requests\Admission;

use Illuminate\Foundation\Http\FormRequest;

class AdmissionRequest extends FormRequest
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
            'student_id'=>'required',
            'college' => 'required|',
            'fees' => 'required|',
            'admission_date' => 'required|',
        ];

        return $rules;
    }

    public function data()
    {
        $data = [
            'student_id' => $this->get('student_id'),
            'college'  => $this->get('college'),
            'fees'  => $this->get('fees'),
            'admission_date'  => $this->get('admission_date'),
        ];

        return $data;

    }
}
