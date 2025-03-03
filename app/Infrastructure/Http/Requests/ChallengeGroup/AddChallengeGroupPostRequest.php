<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Requests\ChallengeGroup;

use App\Application\ChallengeGroups\DTO\AddChallengeGroupPostDTO;
use App\Application\Shared\ConvertsToDTO;
use App\Application\Shared\Factory\FileFactory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

/**
 * @property string $description
 * @property UploadedFile $image
 */
final class AddChallengeGroupPostRequest extends FormRequest implements ConvertsToDTO
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'description' => ['required', 'string', 'max:140'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    public function toDTO(): AddChallengeGroupPostDTO
    {
        return new AddChallengeGroupPostDTO(
            (int) $this->route('id'),
            $this->description,
            FileFactory::fromUploadedFile($this->image)
        );
    }
}
