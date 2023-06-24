<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
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
     * Get user image attribute
     * @param $value
     * @return string
     */
    public function getImageAttribute($value): string
    {
        if($value != Null && file_exists($value)) {
            return $value;
        } else {
            return 'assets/images/avatar.jpg';
        }
    }

    public function educations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UserEducation::class,'user_id','id');
    }

    public function engineer_type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EngineerType::class,'engineer_type_id','id');
    }

    public function scopeApproved() {
        return $this->where('approve_status', "yes");
    }

    public static function getMemberId()
    {
        $latestOrderNumber = User::latest('id')->whereNotNull('member_id')->first();
        $newOrderNumber = str_pad(1, 4, "0", STR_PAD_LEFT);
        if ($latestOrderNumber) {
            $lastOrderNumber = $latestOrderNumber->member_id;
            if ($lastOrderNumber != null) {
                $newSerialNumber = $lastOrderNumber + 1;
                $newOrderNumber = str_pad($newSerialNumber, 4, "0", STR_PAD_LEFT);;
            } else {
                $newOrderNumber = str_pad(1, 4, "0", STR_PAD_LEFT);
            }
        }
        if (User::where('member_id', $newOrderNumber)->exists()) {
            User::getMemberId();
        }
        return $newOrderNumber;
    }
}
