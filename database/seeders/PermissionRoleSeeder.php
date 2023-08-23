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
        // $kepalaBidangIndustriRole->givePermissionTo('view');

        $kepalaBidangDagluRole = Role::create(['name' => 'Kepala Bidang Daglu']);
        // $kepalaBidangDagluRole->givePermissionTo('view');

        $kepalaBidangDagriRole = Role::create(['name' => 'Kepala Bidang Dagri']);
        // $kepalaBidangIndustriRole->givePermissionTo('view');

        $kepalaBidangListrikEnergiRole = Role::create(['name' => 'Kepala Bidang Listrik/Energi']);
        // $kepalaBidangListrikEnergiRole->givePermissionTo('view');

        $kepalaBidangPengujianSertifikasiRole = Role::create(['name' => 'Kepala Bidang Pengujian/Sertifikasi']);
        // $kepalaBidangPengujianSertifikasiRole->givePermissionTo('view');

        $kepalaBidangSDMRole = Role::create(['name' => 'Kepala Bidang SDM']);
        // $kepalaBidangSDMRole->givePermissionTo('view');



        $sekretarisRole = Role::create(['name' => 'sekretaris']);

        $adminRole = Role::create(['name' => 'admin']);
        // gets all permissions via Gate::before rule

        // create demo users
        $user = User::factory()->create([
            'nama' => 'Kepala Dinas',
            'username' => '001',
            'password' => Hash::make('12345678'),
            'id_bidang' => 1,
            'jabatan' => 'Kepala Dinas'
        ]);
        $user->assignRole($kepalaDinasRole);

        $user = User::factory()->create([
            'nama' => 'Sekretaris',
            'username' => '002',
            'password' => Hash::make('12345678'),
            'id_bidang' => 2,
            'jabatan' => 'Sekretaris'
        ]);
        $user->assignRole($sekretarisRole);

        $user = User::factory()->create([
            'nama' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('12345678'),
            'id_bidang' => 3,
            'jabatan' => 'Tata Usaha'
        ]);
        $user->assignRole($adminRole);

        $user = User::factory()->create([
            'nama' => 'Kepala Bidang Industri',
            'username' => '004',
            'password' => Hash::make('12345678'),
            'id_bidang' => 4,
            'jabatan' => 'Kepala Bidang'
        ]);
        $user->assignRole($kepalaBidangIndustriRole);

        $user = User::factory()->create([
            'nama' => 'Kepala Bidang Daglu',
            'username' => '005',
            'password' => Hash::make('12345678'),
            'id_bidang' => 5,
            'jabatan' => 'Kepala Bidang'
        ]);
        $user->assignRole($kepalaBidangDagluRole);

        $user = User::factory()->create([
            'nama' => 'Kepala Bidang Dagri',
            'username' => '006',
            'password' => Hash::make('12345678'),
            'id_bidang' => 6,
            'jabatan' => 'Kepala Bidang'
        ]);
        $user->assignRole($kepalaBidangDagriRole);

        $user = User::factory()->create([
            'nama' => 'Kepala Bidang Listrik/Energi',
            'username' => '007',
            'password' => Hash::make('12345678'),
            'id_bidang' => 7,
            'jabatan' => 'Kepala Bidang'
        ]);
        $user->assignRole($kepalaBidangListrikEnergiRole);

        $user = User::factory()->create([
            'nama' => 'Kepala Bidang Pengujian/Sertifikasi',
            'username' => '008',
            'password' => Hash::make('12345678'),
            'id_bidang' => 8,
            'jabatan' => 'Kepala Bidang'
        ]);
        $user->assignRole($kepalaBidangPengujianSertifikasiRole);

        $user = User::factory()->create([
            'nama' => 'Kepala Bidang SDM',
            'username' => '009',
            'password' => Hash::make('12345678'),
            'id_bidang' => 9,
            'jabatan' => 'Kepala Bidang'
        ]);
        $user->assignRole($kepalaBidangSDMRole);




    }
}
