<?php

namespace App\Http\Requests\Order;

use App\Models\OrderStatus;
use App\Models\OrderType;
use App\Models\Partnership;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'type_id' => 'required|int|exists:'.OrderType::class.',id',
            'partnership_id' => 'required|int|exists:'.Partnership::class.',id',
            'description' => 'required|string|max:500',
            'address' => 'required|string|max:255',
            'amount' => 'required|int|min:1',
            'status_id' => 'required|int|exists:'.OrderStatus::class.',id',
            'worker_ids' => 'array',
            'worker_ids.*' => 'required|int|exists:'.Worker::class.',id',
        ];
    }
}
