<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset cahced roles and permission
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'update disposisi']);

        //create roles and assign existing permissions
        $kepalaDinasRole = Role::create(['name' => 'Kepala Dinas']);
        // $kepalaDinasRole->givePermissionTo('view posts');
        // $kepalaDinasRole->givePermissionTo('create posts');
        // $kepalaDinasRole->givePermissionTo('edit posts');
        //  $kepalaDinasRole->givePermissionTo('delete posts');
        // $kepalaDinasRole->givePermissionTo('publish posts');
        // $kepalaDinasRole->givePermissionTo('unpublish posts');

        $kepalaBidangRole = Role::create(['name' => 'Kepala Bidang']);
        // $kepalaBidangRole->givePermissionTo('view posts');
        // $kepalaBidangRole->givePermissionTo('create posts');
        // $kepalaBidangRole->givePermissionTo('edit posts');
        //  $kepalaBidangRole->givePermissionTo('delete posts');
        // $kepalaBidangRole->givePermissionTo('publish posts');
        // $kepalaBidangRole->givePermissionTo('unpublish posts');

        $sekretarisRole = Role::create(['name' => 'sekretaris']);
        // $sekretarisRole->givePermissionTo('view posts');
        // $sekretarisRole->givePermissionTo('create posts');
        // $sekretarisRole->givePermissionTo('edit posts');
        //  $sekretarisRole->givePermissionTo('delete posts');
        // $sekretarisRole->givePermissionTo('publish posts');
        // $sekretarisRole->givePermissionTo('unpublish posts');

        $adminRole = Role::create(['name' => 'admin']);
        // gets all permissions via Gate::before rule

        // create demo users
        $user = User::factory()->create([
            'nama' => 'Kepala Dinas',
            'username' => 'Kepala Dinas',
            'password' => Hash::make('12345678'),
            'id_bidang' => 1,
            'jabatan' => 'contoh jabatan'
        ]);
        $user->assignRole($kepalaDinasRole);

        $user = User::factory()->create([
            'nama' => 'Kepala Bidang',
            'username' => 'Kepala Bidang',
            'password' => Hash::make('12345678'),
            'id_bidang' => 1,
            'jabatan' => 'contoh jabatan'
        ]);
        $user->assignRole($kepalaBidangRole);

        $user = User::factory()->create([
            'nama' => 'Sekretaris',
            'username' => 'sekretaris',
            'password' => Hash::make('12345678'),
            'id_bidang' => 1,
            'jabatan' => 'contoh jabatan'
        ]);
        $user->assignRole($sekretarisRole);

        $user = User::factory()->create([
            'nama' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('12345678'),
            'id_bidang' => 1,
            'jabatan' => 'contoh jabatan'
        ]);
        $user->assignRole($adminRole);
    }
}
