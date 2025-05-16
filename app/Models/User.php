<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Jobs\SendCustomMailJob;
use App\Notifications\SendCustomMail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Laravel\Sanctum\HasApiTokens;
use MongoDB\Laravel\Eloquent\Model; // MongoDB'yi kullanabilmek için
use MongoDB\Laravel\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject,MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $connection = 'mongodb';
    protected $collection = 'users'; // MongoDB koleksiyonu

    protected $fillable = [
        'name',
        'surname',
        'student_number',
        'phone',
        'email',
        'faculty',
        'department',
        'class',
        'birth_date',
        'password',
        'email_verified_at',
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

    public function getJWTIdentifier()
    {
        return $this->_id; // MongoDB'de primary key "_id" olur
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function hasVerifiedEmail(): bool
    {
        return ! is_null($this->email_verified_at);
    }

    public function markEmailAsVerified(): bool
    {
        return $this->forceFill([
            'email_verified_at' => now(),
        ])->save();
    }

    public function sendEmailVerificationNotification(): void
    {
        $verificationUrl = URL::temporarySignedRoute(
            name: 'verification.verify', // rotanın ismi
            expiration: Carbon::now()->addMinutes(60),
            parameters: [
                'id' => $this->getKey(),
                'hash' => sha1($this->getEmailForVerification()),
            ]
        );
        $mailDetails = [
            'subject' => 'Öğrenci Kulübümüze Hoş Geldiniz! E-posta Doğrulaması Gerekiyor',
            'greeting' => 'Merhaba ' . $this->name . ' ' . $this->surname . ',',
            'content' => 'Öğrenci kulübümüze katıldığınız için çok mutluyuz! Birlikte harika etkinlikler ve projeler gerçekleştireceğiz. ' .
                'Üyeliğinizi tamamlamak için lütfen e-posta adresinizi doğrulayın. Böylece size özel duyurulardan ve fırsatlardan haberdar olabilirsiniz.',
            'buttonText' => 'E-postamı Doğrula',
            'buttonUrl' => $verificationUrl,
        ];
        $this->notify(new SendCustomMail($mailDetails));
       // dispatch(new SendCustomMailJob($this, $mailDetails));
    }


    public function eventApplications()
    {
        return $this->hasMany(EventApplication::class);
    }
}
