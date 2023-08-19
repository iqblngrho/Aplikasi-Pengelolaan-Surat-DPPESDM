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
        Permission::create(['name' => 'delete']);

        //create roles and assign existing permissions
        $kepalaDinasRole = Role::create(['name' => 'Kepala Dinas']);
//         $kepalaDinasRole->givePermissionTo('delete');

        $kepalaBidangIndustriRole = Role::create(['name' => 'Kepala Bidang Industri']);
        $kepalaBidangEksporRole = Role::create(['name' => 'Kepala Bidang Ekspor']);
        $kepalaBidangImporRole = Role::create(['name' => 'Kepala Bidang Impor']);


        $sekretarisRole = Role::create(['name' => 'sekretaris']);

        $adminRole = Role::create(['name' => 'admin']);
        // gets all permissions via Gate::before rule

        // create demo users
        $user = User::factory()->create([
            'nama' => 'Kepala Dinas',
            'username' => 'Kepala Dinas',
            'password' => Hash::make('12345678'),
            'id_bidang' => 1,
            'jabatan' => 'Kepala Dinas'
        ]);
        $user->assignRole($kepalaDinasRole);

        $user = User::factory()->create([
            'nama' => 'Kepala Bidang Industri',
            'username' => 'Kepala Bidang Industri',
            'password' => Hash::make('12345678'),
            'id_bidang' => 3,
            'jabatan' => 'Kabid'
        ]);
        $user->assignRole($kepalaBidangIndustriRole);

        $user = User::factory()->create([
            'nama' => 'Kepala Bidang Ekspor',
            'username' => 'Kepala Bidang Ekspor',
            'password' => Hash::make('12345678'),
            'id_bidang' => 5,
            'jabatan' => 'Kabid'
        ]);
        $user->assignRole($kepalaBidangEksporRole);

        $user = User::factory()->create([
            'nama' => 'Kepala Bidang Impor',
            'username' => 'Kepala Bidang Impor',
            'password' => Hash::make('12345678'),
            'id_bidang' => 6,
            'jabatan' => 'Kabid'
        ]);
        $user->assignRole($kepalaBidangImporRole);

        $user = User::factory()->create([
            'nama' => 'Sekretaris',
            'username' => 'sekretaris',
            'password' => Hash::make('12345678'),
            'id_bidang' => 2,
            'jabatan' => 'Sekretaris'
        ]);
        $user->assignRole($sekretarisRole);

        $user = User::factory()->create([
            'nama' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('12345678'),
            'id_bidang' => 4,
            'jabatan' => 'Tata Usaha'
        ]);
        $user->assignRole($adminRole);
    }
}
