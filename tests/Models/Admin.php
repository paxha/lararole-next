<?php


namespace Lararole\Tests\Models;


use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;

class Admin extends Model implements AuthorizableContract, AuthenticatableContract
{
    use SoftDeletes, Authorizable, Authenticatable;

    protected $fillable = [
        'name',
    ];
}