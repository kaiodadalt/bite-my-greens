<?php

namespace App\Infrastructure\Http\Requests\ChallengeGroup;

use App\Application\ChallengeGroups\DTOs\ChallengeGroupDTO;
use App\Application\ChallengeGroups\DTOs\CreateChallengeGroupDTO;
use App\Infrastructure\Http\Requests\ConvertsToDTO;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $name
 * @property string $end_date
 */
class CreateChallengeGroupRequest extends FormRequest implements ConvertsToDTO
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:80'],
            'end_date' => ['required', 'date', 'after:today'],
        ];
    }

    public function toDTO(): ChallengeGroupDTO
    {
        return new ChallengeGroupDTO(
            id: null,
            name: $this->name,
            end_date: $this->end_date,
            created_by: auth()->user()->id
        );
    }
}
