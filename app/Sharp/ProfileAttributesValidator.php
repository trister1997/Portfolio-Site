<?php

namespace App\Sharp;

use Code16\Sharp\Http\WithSharpFormContext;
use Illuminate\Foundation\Http\FormRequest;

class ProfileAttributesValidator extends FormRequest {

    use WithSharpFormContext;

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'name' => 'required',
            'job_title' => 'required',
            'email' => 'required',
            'about_me.text' => 'required'
        ];
    }

}