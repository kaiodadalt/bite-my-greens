<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Models\ChallengeGroups;

use App\Infrastructure\Persistence\Models\Auth\User;
use Database\Factories\ChallengeGroups\ChallengeGroupFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $challenge_group_id
 * @property int $user_id
 */
final class ChallengeGroupUser extends Model
{
    /** @use HasFactory<ChallengeGroupFactory> */
    use HasFactory;

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'challenge_group_id',
        'user_id',
    ];

    /**
     * @return BelongsTo<ChallengeGroup, ChallengeGroupUser>
     */
    public function challengeGroup(): BelongsTo
    {
        return $this->belongsTo(ChallengeGroup::class, 'challenge_group_id');
    }

    /**
     * @return BelongsTo<User, ChallengeGroupUser>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
