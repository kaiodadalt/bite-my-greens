<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Requests\ChallengeGroup;

use App\Application\ChallengeGroups\DTO\UpdateChallengeGroupDTO;
use App\Infrastructure\Http\Requests\ConvertsToDTO;
use DateTimeImmutable;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property ?string $name
 * @property ?string $end_date
 */
final class UpdateChallengeGroupRequest extends FormRequest implements ConvertsToDTO
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
            (int) $this->route('id'),
            $this->name,
            new DateTimeImmutable($this->end_date),
        );
    }
}
