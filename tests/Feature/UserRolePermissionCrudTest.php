<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserRolePermissionCrudTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function test_super_admin_can_access_user_crud_and_assign_roles(): void
    {
        $superAdmin = User::where('email', 'superadmin@bersihsebagian.com')->first();
        $this->actingAs($superAdmin);

        // 1. Index
        $response = $this->get(route('admin.users.index'));
        $response->assertStatus(200);
        $response->assertSee('User Management');
        $response->assertSee('superadmin@bersihsebagian.com');

        // 2. Create Page
        $createResponse = $this->get(route('admin.users.create'));
        $createResponse->assertStatus(200);
        $createResponse->assertSee('Penugasan Peran (Assign To Role)');

        // 3. Store User with Role
        $storeResponse = $this->post(route('admin.users.store'), [
            'name' => 'Staff Baru',
            'email' => 'staffbaru@bersihsebagian.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'roles' => ['Admin'],
        ]);
        $storeResponse->assertRedirect(route('admin.users.index'));

        $newUser = User::where('email', 'staffbaru@bersihsebagian.com')->first();
        $this->assertNotNull($newUser);
        $this->assertTrue($newUser->hasRole('Admin'));

        // 4. Edit & Sync Role
        $editResponse = $this->get(route('admin.users.edit', $newUser));
        $editResponse->assertStatus(200);
        $editResponse->assertSee('Edit Akun: Staff Baru');

        $updateResponse = $this->put(route('admin.users.update', $newUser), [
            'name' => 'Staff Diperbarui',
            'email' => 'staffbaru@bersihsebagian.com',
            'roles' => ['Owner'],
        ]);
        $updateResponse->assertRedirect(route('admin.users.index'));

        $newUser->refresh();
        $this->assertEquals('Staff Diperbarui', $newUser->name);
        $this->assertTrue($newUser->hasRole('Owner'));
        $this->assertFalse($newUser->hasRole('Admin'));

        // 5. Delete User
        $deleteResponse = $this->delete(route('admin.users.destroy', $newUser));
        $deleteResponse->assertRedirect(route('admin.users.index'));
        $this->assertNull(User::where('email', 'staffbaru@bersihsebagian.com')->first());

        // 6. Self Delete Prevention
        $selfDeleteResponse = $this->delete(route('admin.users.destroy', $superAdmin));
        $this->assertNotNull(User::where('email', 'superadmin@bersihsebagian.com')->first());
    }

    public function test_super_admin_can_access_role_crud_and_assign_permissions(): void
    {
        $superAdmin = User::where('email', 'superadmin@bersihsebagian.com')->first();
        $this->actingAs($superAdmin);

        // 1. Index
        $response = $this->get(route('admin.roles.index'));
        $response->assertStatus(200);
        $response->assertSee('Role & Permission Management');

        // 2. Create Page
        $createResponse = $this->get(route('admin.roles.create'));
        $createResponse->assertStatus(200);
        $createResponse->assertSee('Penugasan Hak Akses (Role Assign To Permission)');

        // 3. Store Role with Permissions
        $storeResponse = $this->post(route('admin.roles.store'), [
            'name' => 'Supervisor',
            'permissions' => ['user.view', 'access.dashboard'],
        ]);
        $storeResponse->assertRedirect(route('admin.roles.index'));

        $newRole = Role::where('name', 'Supervisor')->first();
        $this->assertNotNull($newRole);
        $this->assertTrue($newRole->hasPermissionTo('user.view'));
        $this->assertTrue($newRole->hasPermissionTo('access.dashboard'));

        // 4. Edit & Sync Permissions
        $editResponse = $this->get(route('admin.roles.edit', $newRole));
        $editResponse->assertStatus(200);

        $updateResponse = $this->put(route('admin.roles.update', $newRole), [
            'name' => 'Senior Supervisor',
            'permissions' => ['menu.view'],
        ]);
        $updateResponse->assertRedirect(route('admin.roles.index'));

        $newRole->refresh();
        $this->assertEquals('Senior Supervisor', $newRole->name);
        $this->assertTrue($newRole->hasPermissionTo('menu.view'));
        $this->assertFalse($newRole->hasPermissionTo('user.view'));

        // 5. Delete Role
        $deleteResponse = $this->delete(route('admin.roles.destroy', $newRole));
        $deleteResponse->assertRedirect(route('admin.roles.index'));
        $this->assertNull(Role::where('name', 'Senior Supervisor')->first());

        // 6. Super Admin Role Delete Protection
        $superAdminRole = Role::where('name', 'Super Admin')->first();
        $this->delete(route('admin.roles.destroy', $superAdminRole));
        $this->assertNotNull(Role::where('name', 'Super Admin')->first());
    }

    public function test_super_admin_can_access_permission_crud(): void
    {
        $superAdmin = User::where('email', 'superadmin@bersihsebagian.com')->first();
        $this->actingAs($superAdmin);

        // 1. Index
        $response = $this->get(route('admin.permissions.index'));
        $response->assertStatus(200);
        $response->assertSee('Permissions List');

        // 2. Create Page
        $createResponse = $this->get(route('admin.permissions.create'));
        $createResponse->assertStatus(200);

        // 3. Store Permission
        $storeResponse = $this->post(route('admin.permissions.store'), [
            'name' => 'service.booking',
        ]);
        $storeResponse->assertRedirect(route('admin.permissions.index'));

        $newPerm = Permission::where('name', 'service.booking')->first();
        $this->assertNotNull($newPerm);

        // 4. Edit Permission
        $editResponse = $this->get(route('admin.permissions.edit', $newPerm));
        $editResponse->assertStatus(200);

        $updateResponse = $this->put(route('admin.permissions.update', $newPerm), [
            'name' => 'service.schedule',
        ]);
        $updateResponse->assertRedirect(route('admin.permissions.index'));

        $newPerm->refresh();
        $this->assertEquals('service.schedule', $newPerm->name);

        // 5. Delete Permission
        $deleteResponse = $this->delete(route('admin.permissions.destroy', $newPerm));
        $deleteResponse->assertRedirect(route('admin.permissions.index'));
        $this->assertNull(Permission::where('name', 'service.schedule')->first());
    }

    public function test_sidebar_highlights_active_menu_on_nested_resource_routes(): void
    {
        $superAdmin = User::where('email', 'superadmin@bersihsebagian.com')->first();
        $this->actingAs($superAdmin);

        // When visiting create page, sidebar User Management menu should have aria-current="page" or active classes
        $response = $this->get(route('admin.users.create'));
        $response->assertStatus(200);
        $response->assertSee('aria-current="page"', false);
    }
}
