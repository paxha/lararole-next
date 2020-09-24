<?php

namespace Lararole\Tests\Unit;

use Illuminate\Support\Facades\Schema;
use Lararole\Tests\TestCase;

class MultiProvidersTest extends TestCase
{
    public function testDatabaseHasTablesAccordingToProviders()
    {
        foreach (config('lararole.providers') as $key => $provider) {
            $this->assertTrue(Schema::hasTable("${key}_modules"));
            $this->assertTrue(Schema::hasTable("${key}_roles"));
            $this->assertTrue(Schema::hasTable("${key}_permissions"));
            $this->assertTrue(Schema::hasTable("${key}_module_role"));
            $this->assertTrue(Schema::hasTable("${key}_role_user"));
        }
    }
}