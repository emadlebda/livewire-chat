<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * determine if the user belongs in a conversation.
     * @param int $conversationId
     * @return bool
     */
    public function isInConversation(int $conversationId): bool
    {
        return $this->conversations->contains('id', $conversationId);
    }

    /**
     * determine if the user has read the conversation
     * @param Conversation $conversation
     * @return mixed
     */
    public function hasRead(Conversation $conversation)
    {
        return $this->conversations->find($conversation->id)->pivot->read_at;
    }

    /**
     * returns user's gravatar url
     * @return string
     */
    public function avatar(): string
    {
        return "https://www.gravatar.com/avatar/" . md5(strtolower(trim($this->email))) . "?d=mm&s=80";

    }


    /**
     * @return BelongsToMany
     */
    public function conversations(): BelongsToMany
    {
        return $this->belongsToMany(Conversation::class)
            ->withPivot('read_at');
    }
}
