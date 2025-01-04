<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Geographic\District;
use App\Models\Geographic\Province;
use App\Models\Geographic\SubDistrict;
use App\Models\Geographic\SubDistrictVillage;
use App\Notifications\ResetPasswordNotification;
use App\Trait\AuditTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, AuditTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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

    public function hasPermissionStartingWith($prefix)
    {
        $permissions = $this->getPermissionsViaRoles();

        return $permissions->contains(function ($permission) use ($prefix) {
            return strpos($permission->name, $prefix) === 0;
        });
    }

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id')->withTrashed();
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id')->withTrashed();
    }

    public function subDistrict()
    {
        return $this->belongsTo(SubDistrict::class, 'sub_district_id', 'id')->withTrashed();
    }

    public function subDistrictVillage()
    {
        return $this->belongsTo(SubDistrictVillage::class)->withTrashed();
    }

    public function roleName()
    {
        return $this->getRoleNames()->join(',') == '' ? '-' : $this->getRoleNames()->join(',');
    }
}
