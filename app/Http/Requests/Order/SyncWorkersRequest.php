<?php

namespace App\Http\Requests\Order;

use App\Models\Worker;
use Illuminate\Foundation\Http\FormRequest;

class SyncWorkersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'worker_ids' => 'required|array',
            'worker_ids.*' => 'int|exists:'.Worker::class.',id',
        ];
    }
}
