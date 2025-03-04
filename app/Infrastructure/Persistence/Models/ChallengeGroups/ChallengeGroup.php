<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Models\ChallengeGroups;

use App\Infrastructure\Persistence\Models\Auth\User;
use Database\Factories\ChallengeGroups\ChallengeGroupFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $created_by
 * @property string $name
 * @property User $creator
 */
final class ChallengeGroup extends Model
{
    /** @use HasFactory<ChallengeGroupFactory> */
    use HasFactory;

    protected $fillable = [
        'created_by',
        'name',
        'end_date',
    ];

    protected $casts = [
        'end_date' => 'immutable_date',
    ];

    public static function newFactory(): ChallengeGroupFactory
    {
        return new ChallengeGroupFactory;
    }

    /**
     * @return BelongsTo<User, self>
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * @return BelongsToMany<User, ChallengeGroup>
     */
    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'challenge_groups_users',
            'challenge_group_id',
            'user_id'
        )->withPivot(['total_score']);
    }

    /**
     * @return HasMany<ChallengeGroupPost, ChallengeGroup>
     */
    public function posts(): HasMany
    {
        return $this->hasMany(
            ChallengeGroupPost::class,
            'challenge_group_id'
        );
    }
}
