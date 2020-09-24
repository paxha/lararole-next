<?php


namespace Lararole\Tests\Traits;


use RecursiveRelationships\Traits\HasRecursiveRelationships;
use Sluggable\Traits\Sluggable;

trait UserHasRoles
{
    use HasRecursiveRelationships, Sluggable;

    protected $fillable = [
        'module_id', 'name',
    ];

    public function getParentKeyName()
    {
        return 'module_id';
    }

    public static function separator(): string
    {
        return '_';
    }
}