<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Requests\ChallengeGroup;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $challenge_code
 */
final class ExitChallengeGroupRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'challenge_code' => ['required', 'string', 'max:80'],
        ];
    }
}
