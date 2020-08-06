<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Email
 *
 * @property int $id
 * @property string $email
 * @property string $sender_email
 * @property string $delivery_status
 * @property string $send_date
 * @property int $given_to_user
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereDeliveryStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereGivenToUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereSendDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereSenderEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Email extends Model
{
    protected $fillable = [
        'email','sender_email','delivery_status','send_date'
    ];
    protected $visible = [
        'email',
        'sender_email',
        'delivery_status',
        'send_date'
    ];
}
