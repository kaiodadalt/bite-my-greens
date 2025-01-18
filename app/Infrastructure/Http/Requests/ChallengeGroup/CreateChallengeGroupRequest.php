<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Requests\ChallengeGroup;

use App\Application\ChallengeGroups\DTO\CreateChallengeGroupDTO;
use App\Infrastructure\Http\Requests\ConvertsToDTO;
use DateTimeImmutable;
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

    public function toDTO(): CreateChallengeGroupDTO
    {
        return new CreateChallengeGroupDTO(
            $this->name,
            new DateTimeImmutable($this->end_date),
        );
    }
}
