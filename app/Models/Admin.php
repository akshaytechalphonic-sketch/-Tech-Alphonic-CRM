<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;


class Admin extends Model implements Authenticatable
{
    use HasFactory,AuthenticableTrait;
      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guard="admin";
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'rand_id',
        'mobile_no',
        'title',
        'birth_date',
        'gender',
        'post_code',
        'street',
        'town',
        'country',
        'profileImage',
        'AcademicDocumentUpload',
        'email_verified_at',
        'role_id',
        'remember_token',
    ];


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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function getRole() {
        return $this->hasOne(Roles::class, 'id', 'role_id')->select('id','name');
    }

    public function get_role() {
        $permission = DB::table('role_has_permissions')->where('role_id',Auth::guard('admin')->user()->role_id)->get(['permission_id']);
        return $permission;
  }





}
