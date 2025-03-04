<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Models\ChallengeGroups;

use App\Infrastructure\Persistence\Models\Auth\User;
use Database\Factories\ChallengeGroups\ChallengeGroupPostFactory;
use Database\Factories\ChallengeGroups\ChallengeGroupUserFactory;
use DateTimeImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $challenge_group_id
 * @property int $user_id
 * @property string $description
 * @property string $image
 * @property int $score
 * @property DateTimeImmutable $created_at
 * @property DateTimeImmutable $updated_at
 */
final class ChallengeGroupPost extends Model
{
    /** @use HasFactory<ChallengeGroupUserFactory> */
    use HasFactory;

    public $table = 'challenge_groups_posts';

    protected $fillable = [
        'challenge_group_id',
        'user_id',
        'description',
        'image',
        'score',
        'created_at',
        'updated_at',
    ];

    public static function newFactory(): ChallengeGroupPostFactory
    {
        return new ChallengeGroupPostFactory;
    }

    /**
     * @return BelongsTo<ChallengeGroup, ChallengeGroupPost>
     */
    public function challengeGroup(): BelongsTo
    {
        return $this->belongsTo(ChallengeGroup::class, 'challenge_group_id');
    }

    /**
     * @return BelongsTo<User, ChallengeGroupPost>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
