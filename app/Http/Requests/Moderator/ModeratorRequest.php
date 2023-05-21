<?php

namespace App\Http\Requests\Moderator;

use App\Enums\Moderator\Status;
use JetBrains\PhpStorm\ArrayShape;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property array moderator
 */
final class ModeratorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['moderator.name'            => "string[]",
                  'moderator.email'           => "string[]",
                  'moderator.global_settings' => "string[]",
                  'moderator.status'          => "array"
    ])]
    public function rules(): array
    {
        return [
            'moderator.name'            => ['required', 'string', 'min:3', 'max:255'],
            'moderator.email'           => ['required', 'email:rfc,dns', 'exists:moderators,email'],
            'moderator.global_settings' => ['required', 'boolean'],
            'moderator.status'          => ['required', 'string', new Enum(Status::class)],
        ];
    }
}