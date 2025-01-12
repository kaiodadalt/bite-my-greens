<?php

namespace App\Infrastructure\Http\Requests\ChallengeGroup;

use App\Application\ChallengeGroups\DTO\UpdateChallengeGroupDTO;
use App\Infrastructure\Http\Requests\ConvertsToDTO;
use DateTime;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property ?string $name
 * @property ?string $end_date
 */
class UpdateChallengeGroupRequest extends FormRequest implements ConvertsToDTO
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['string', 'max:80', 'required_without_all:end_date'],
            'end_date' => ['date', 'after:today', 'required_without_all:name'],
        ];
    }

    public function toDTO(): UpdateChallengeGroupDTO
    {
        return new UpdateChallengeGroupDTO(
            $this->route('id'),
            $this->name,
            new DateTime($this->end_date),
        );
    }
}
