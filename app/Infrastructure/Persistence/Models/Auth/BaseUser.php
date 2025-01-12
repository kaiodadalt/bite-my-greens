<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Models\Auth;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Application\Auth\DTOs\UserDTO;
use Database\Factories\Auth\UserFactory;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property DateTime|null $email_verified_at
 * @property string|null $remember_token
 * @method static create(array $array)
 */
abstract class BaseUser extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function newFactory(): UserFactory
    {
        return new UserFactory();
    }

    public function toDTO(): UserDTO
    {
        return new UserDTO(
            $this->id,
            $this->name,
            $this->email,
        );
    }
}
