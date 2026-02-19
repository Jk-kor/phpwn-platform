<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Les attributs qui peuvent ?tre assign?s en masse.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',  // name을 username으로 변경
        'email',
        'password',
        'role',      // role 추가 (일반 유저/관리자 구분용)
        'balance',   // balance 추가 (포인트/잔액용)
    ];

    /**
     * Les attributs qui doivent ?tre masqu?s lors de la s?rialisation.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Obtenir les attributs qui doivent ?tre convertis.
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

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
