<?php

namespace Tests\Unit;

use Tests\TestCase;
use \App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PermissionTest extends TestCase
{
    use RefreshDatabase;
    protected static $user;
    public function setUp() :void
    {
        parent::setUp();
        $this->seed(\RolesAndPermissionsSeeder::class);
        self::$user = factory(User::class)->create();
    }
    public function testCanAssign()
    {
        //test role
        $permission = 'create shake';
        $this->assertFalse(self::$user->can($permission));
        self::$user->assignRole('user');
        $this->assertTrue(self::$user->can($permission));
        //test permission
    }

    public function testCanRemove()
    {
        //test role
        $permission = 'create shake';
        self::$user->assignRole('user');
        $this->assertTrue(self::$user->can($permission));
        self::$user->revokePermissionTo($permission);
        $this->assertFalse(self::$user->can($permission));

        //test role
        self::$user->assignRole('user');
        $this->assertTrue(self::$user->can($permission));
        self::$user->removeRole('user');
        $this->assertFalse(self::$user->can($permission));
    }
}
