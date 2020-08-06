<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserCredit
 *
 * @property int $id
 * @property int $credit
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $currentUser
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserCredit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserCredit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserCredit query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserCredit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserCredit whereCredit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserCredit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserCredit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserCredit whereUserId($value)
 * @mixin \Eloquent
 */
class UserCredit extends Model
{
    public const CREDIT_VALUE = 20000;
    protected $fillable = [
        'user_id',
        'credit'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function currentUser()
    {
        return $this->hasOne(User::class);
    }
}
