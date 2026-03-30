<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Framework\Auth\IdentityInterface;

class User extends Model implements IdentityInterface
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'surname',
        'name',
        'patronymic',
        'phone',
        'email',
        'login',
        'password',
        'role',
        'avatar'
    ];

    protected static function booted()
    {
        static::creating(function ($user) {
            if (isset($user->password)) {
                $user->password = md5($user->password);
            }
        });
    }

    //Выборка пользователя по первичному ключу
    public function findIdentity(int $id)
    {
        return self::find($id);
    }

    //Возврат первичного ключа
    public function getId(): int
    {
        return $this->id;
    }

    //Возврат аутентифицированного пользователя
    public function attemptIdentity(array $credentials)
    {
        return self::where(['login' => $credentials['login'],
            'password' => md5($credentials['password'])])->first();
    }
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
    public function isCommandant(): bool
    {
        return $this->role === 'commandant';
    }
}