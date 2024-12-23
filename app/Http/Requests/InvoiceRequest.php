<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'invoice_date' => 'required',
            'due_date' => 'required',
            'company_name' => 'required',
            'company_address_line_1' => 'required',
            'company_address_line_2' => '',
            'company_city' => 'required',
            'company_county' => '',
            'company_postcode' => 'required',
            'company_vat_number' => 'required',
            'client_name' => 'required',
            'client_address_line_1' => 'required',
            'client_address_line_2' => '',
            'client_city' => 'required',
            'client_county' => '',
            'client_postcode' => 'required',
            'status' => '',
            'note' => '',
            'vat_percentage' => ''
        ];
    }
}
