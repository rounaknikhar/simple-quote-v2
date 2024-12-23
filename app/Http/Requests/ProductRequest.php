<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest  extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'amount' => 'required',
            'unit' => 'required',
            'total_charge' => 'required',
        ];
    }
}
