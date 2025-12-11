<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDeviceLoanRequest extends FormRequest
{
    public function authorize(): bool
    {
        // uprav podľa tvojej politiky/guardu
        return $this->user()?->can('manage-users') ?? true;
    }

    public function rules(): array
    {
        return [
            'device_loan_start_at' => ['required', 'date'],
            'device_loan_serial'   => ['required', 'string', 'max:191'],
            'device_loan_days'     => ['required', 'integer', 'min:1', 'max:3650'],
        ];
    }

    public function messages(): array
    {
        return [
            'device_loan_start_at.required' => 'Zadaj dátum začiatku zápožičky.',
            'device_loan_serial.required'   => 'Zadaj sériové číslo zariadenia.',
            'device_loan_days.required'     => 'Zadaj počet dní zápožičky.',
        ];
    }
}
