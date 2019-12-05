<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission_listar = App\Permission::create([
            'name' => 'listar',
            'display_name' => 'listar',
            'description' => 'listar',
        ]);
        $permission_registrar = App\Permission::create([
            'name' => 'registrar',
            'display_name' => 'registrar',
            'description' => 'registrar',
        ]);
        $permission_editar = App\Permission::create([
            'name' => 'editar',
            'display_name' => 'editar',
            'description' => 'editar',
        ]);
        $permission_eliminar = App\Permission::create([
            'name' => 'eliminar',
            'display_name' => 'eliminar',
            'description' => 'eliminar',
        ]);
        $permission_imprimir = App\Permission::create([
            'name' => 'imprimir',
            'display_name' => 'imprimir',
            'description' => 'imprimir',
        ]);
        // roles
        $role_admin = App\Role::create([
            'name' => 'admin',
            'display_name' => 'Administrador',
            'description' => 'Administrador',
        ]);
        $role_usuario = App\Role::create([
            'name' => 'usuario',
            'display_name' => 'Usuario',
            'description' => 'Usuario',
        ]);

        // usuarios
        $user_admin = App\User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
        ]);        
        $user_admin->attachRole($role_admin);
        $role_admin->attachPermission($permission_listar);
        $role_admin->attachPermission($permission_registrar);
        $role_admin->attachPermission($permission_editar);
        $role_admin->attachPermission($permission_eliminar);
        $role_admin->attachPermission($permission_imprimir);

        $user_usuario = App\User::create([
            'name' => 'usuario',
            'email' => 'usuario@usuario.com',
            'password' => bcrypt('usuario'),
        ]);        
        $user_usuario->attachRole($role_usuario);
        $role_usuario->attachPermission($permission_listar);
        $role_usuario->attachPermission($permission_registrar);
        $role_usuario->attachPermission($permission_editar);
        $role_usuario->attachPermission($permission_imprimir);
    }
}
