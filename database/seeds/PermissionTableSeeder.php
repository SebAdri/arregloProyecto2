<?php

use Illuminate\Database\Seeder;
use App\Permission;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = new Permission;
        $permission->permission_name = 'obras';
        $permission->permission_description = 'Obras de la contructora';
        $permission->permission_widget = 'b';
        $permission->permission_level = '1';
        $permission->id_padre = null;
        $permission->save();

        $permission = new Permission;
        $permission->permission_name = 'docu';
        $permission->permission_description = 'documentos de la contructora';
        $permission->permission_widget = 'b';
        $permission->permission_level = '2';
        $permission->id_padre = 1;
        $permission->save();


        $permission = new Permission;
        $permission->permission_name = 'storage';
        $permission->permission_description = 'almacen de la contructora';
        $permission->permission_widget = 'b';
        $permission->permission_level = '2';
        $permission->id_padre = 1;
        $permission->save();

        $permission = new Permission;
        $permission->permission_name = 'empl';
        $permission->permission_description = 'empleados de la contructora';
        $permission->permission_widget = 'b';
        $permission->permission_level = '2';
        $permission->id_padre = '1';
        $permission->save();

        $permission = new Permission;
        $permission->permission_name = 'addDoc';
        $permission->permission_description = 'agregar documentos';
        $permission->permission_widget = 'c';
        $permission->permission_level = '3';
        $permission->id_padre = 2;
        $permission->save();

        $permission = new Permission;
        $permission->permission_name = 'ediDoc';
        $permission->permission_description = 'editar documentos';
        $permission->permission_widget = 'c';
        $permission->permission_level = '3';
        $permission->id_padre = 2;
        $permission->save();

        $permission = new Permission;
        $permission->permission_name = 'delDoc';
        $permission->permission_description = 'eliminar documentos';
        $permission->permission_widget = 'c';
        $permission->permission_level = '3';
        $permission->id_padre = 2;
        $permission->save();

// (8, 'assEmpl', 'asignacion empleados', 'c', '3', 4, '2018-09-14 20:47:53', '2018-09-14 20:47:54'),
        $permission = new Permission;
        $permission->permission_name = 'assEmpl';
        $permission->permission_description = 'asignacion empleados';
        $permission->permission_widget = 'c';
        $permission->permission_level = '4';
        $permission->id_padre = '4';
        $permission->save();

// (9, 'desvEmpl', 'desvinculacion empleados', 'c', '3', 4, '2018-09-15 00:58:40', '2018-09-15 00:58:40'),
        $permission = new Permission;
        $permission->permission_name = 'desvEmpl';
        $permission->permission_description = 'desvinculacion empleados';
        $permission->permission_widget = 'c';
        $permission->permission_level = '4';
        $permission->id_padre = 4;
        $permission->save();

    // (10, 'addPed', 'realizar pedido', 'c', '3', 3, '2018-09-15 00:58:41', '2018-09-15 00:58:41'),
        $permission = new Permission;
        $permission->permission_name = 'addPed';
        $permission->permission_description = 'realizar pedido';
        $permission->permission_widget = 'c';
        $permission->permission_level = '3';
        $permission->id_padre = 3;
        $permission->save();

    // (11, 'ctrlSto', 'control de stock', 'c', '3', 3, '2018-09-15 00:58:41', '2018-09-15 00:58:41'),
        $permission = new Permission;
        $permission->permission_name = 'ctrlSto';
        $permission->permission_description = 'control de stock';
        $permission->permission_widget = 'c';
        $permission->permission_level = '3';
        $permission->id_padre = 3;
        $permission->save();

    // (12, 'sec', 'seguridad', 'b', '1', NULL, '2018-09-14 21:20:00', '2018-09-14 21:20:01'),
        $permission = new Permission;
        $permission->permission_name = 'sec';
        $permission->permission_description = 'seguridad';
        $permission->permission_widget = 'b';
        $permission->permission_level = '1';
        $permission->id_padre = null;
        $permission->save();

    // (13, 'usr', 'usuarios', 'b', '2', 12, '2018-09-19 18:40:49', '2018-09-19 18:40:49'),
        $permission = new Permission;
        $permission->permission_name = 'usr';
        $permission->permission_description = 'usuarios';
        $permission->permission_widget = 'b';
        $permission->permission_level = '2';
        $permission->id_padre = 12;
        $permission->save();

    // (14, 'role', 'roles', 'b', '2', 12, '2018-09-19 18:41:13', '2018-09-19 18:41:14'),
        $permission = new Permission;
        $permission->permission_name = 'role';
        $permission->permission_description = 'roles';
        $permission->permission_widget = 'b';
        $permission->permission_level = '2';
        $permission->id_padre = 12;
        $permission->save();

    // (15, 'addUse', 'agregar Usuario', 'c', '3', 14, '2017-09-26 12:31:45', '2018-09-26 12:31:45'),
        $permission = new Permission;
        $permission->permission_name = 'addUse';
        $permission->permission_description = 'agregar Usuario';
        $permission->permission_widget = 'c';
        $permission->permission_level = '3';
        $permission->id_padre = 14;
        $permission->save();

    // (16, 'ediUse', 'editar usuario', 'c', '3', 14, '2019-09-26 12:32:30', '2018-09-26 12:32:53'),
        $permission = new Permission;
        $permission->permission_name = 'ediUse';
        $permission->permission_description = 'editar usuario';
        $permission->permission_widget = 'c';
        $permission->permission_level = '3';
        $permission->id_padre = 14;
        $permission->save();

    // (17, 'delUse', 'eliminar Usuario', 'c', '3', 14, '2018-09-26 12:33:27', '2018-09-26 12:33:30'),
        $permission = new Permission;
        $permission->permission_name = 'delUse';
        $permission->permission_description = 'eliminar Usuario';
        $permission->permission_widget = 'c';
        $permission->permission_level = '3';
        $permission->id_padre = 14;
        $permission->save();        

    // (18, 'mant', 'mantenimiento', 'b', '1', NULL, '2018-10-03 21:14:00', '2018-10-07 11:58:51'),
        $permission = new Permission;
        $permission->permission_name = 'mant';
        $permission->permission_description = 'mantenimiento';
        $permission->permission_widget = 'b';
        $permission->permission_level = '1';
        $permission->id_padre = null;
        $permission->save();

    // (19, 'addEmpl', 'agregar empleados', 'c', '3', 20, '2018-10-03 21:14:50', '2018-10-03 21:14:56'),
        $permission = new Permission;
        $permission->permission_name = 'addEmpl';
        $permission->permission_description = 'agregar empleados';
        $permission->permission_widget = 'c';
        $permission->permission_level = '3';
        $permission->id_padre = 20;
        $permission->save();

    // (20, 'emplMant', 'mantenimiento empleado', 'b', '2', 18, '2018-10-03 21:39:12', '2018-10-07 11:52:25'),
        $permission = new Permission;
        $permission->permission_name = 'addEmpl';
        $permission->permission_description = 'agregar empleados';
        $permission->permission_widget = 'c';
        $permission->permission_level = '3';
        $permission->id_padre = 20;
        $permission->save();

    // (21, 'ediEmpl', 'editar empleados', 'c', '3', 20, '2018-10-07 11:48:38', '2018-10-07 11:48:38'),
        $permission = new Permission;
        $permission->permission_name = 'ediEmpl';
        $permission->permission_description = 'editar empleados';
        $permission->permission_widget = 'c';
        $permission->permission_level = '3';
        $permission->id_padre = 20;
        $permission->save();

    // (22, 'delEmpl', 'eliminar empleados', 'c', '3', 20, '2018-10-07 11:49:20', '2018-10-07 11:49:21'),
        $permission = new Permission;
        $permission->permission_name = 'delEmpl';
        $permission->permission_description = 'eliminar empleados';
        $permission->permission_widget = 'c';
        $permission->permission_level = '3';
        $permission->id_padre = 20;
        $permission->save();

    // (23, 'rubrMant', 'mantenimiento rubro', 'b', '2', 18, '2018-10-07 11:52:18', '2018-10-07 11:52:23'),
        $permission = new Permission;
        $permission->permission_name = 'rubrMant';
        $permission->permission_description = 'mantenimiento rubro';
        $permission->permission_widget = 'b';
        $permission->permission_level = '2';
        $permission->id_padre = 18;
        $permission->save();

    // (24, 'addRub', 'agregar rubro', 'c', '3', 23, '2018-10-07 11:58:53', '2018-10-07 11:58:54'),
        $permission = new Permission;
        $permission->permission_name = 'addRub';
        $permission->permission_description = 'agregar rubro';
        $permission->permission_widget = 'c';
        $permission->permission_level = '3';
        $permission->id_padre = 23;
        $permission->save();

    // (25, 'ediRub', 'editar rubro', 'c', '3', 23, '2018-10-07 11:53:09', '2018-10-07 11:58:55'),
        $permission = new Permission;
        $permission->permission_name = 'ediRub';
        $permission->permission_description = 'editar rubro';
        $permission->permission_widget = 'c';
        $permission->permission_level = '3';
        $permission->id_padre = 23;
        $permission->save();

    // (26, 'delRub', 'eliminar rubro', 'c', '3', 23, '2018-10-07 11:58:58', '2018-10-07 11:58:57'),
        $permission = new Permission;
        $permission->permission_name = 'delRub';
        $permission->permission_description = 'eliminar rubro';
        $permission->permission_widget = 'c';
        $permission->permission_level = '3';
        $permission->id_padre = 23;
        $permission->save();

    // (27, 'mateMant', 'mantenimiendo materiales', 'c', '3', 18, '2018-10-07 11:54:28', '2018-10-07 11:59:19'),
        $permission = new Permission;
        $permission->permission_name = 'mateMant';
        $permission->permission_description = 'mantenimiendo materiales';
        $permission->permission_widget = 'c';
        $permission->permission_level = '3';
        $permission->id_padre = 18;
        $permission->save();

    // (28, 'addMate', 'agregar materiales', 'c', '3', 27, '2018-10-07 11:59:00', '2018-10-07 11:59:18'),
        $permission = new Permission;
        $permission->permission_name = 'addMate';
        $permission->permission_description = 'agregar materiales';
        $permission->permission_widget = 'c';
        $permission->permission_level = '3';
        $permission->id_padre = 27;
        $permission->save();

    // (29, 'ediMate', 'editar materiales', 'c', '3', 27, '2018-10-07 11:56:37', '2018-10-07 11:59:11'),
        $permission = new Permission;
        $permission->permission_name = 'addEmpl';
        $permission->permission_description = 'agregar empleados';
        $permission->permission_widget = 'c';
        $permission->permission_level = '3';
        $permission->id_padre = 20;
        $permission->save();

    // (30, 'delMate', 'eliminar materiales', 'c', '3', 27, '2018-10-07 11:59:01', '2018-10-07 11:59:13'),
        $permission = new Permission;
        $permission->permission_name = 'delMate';
        $permission->permission_description = 'eliminar materiales';
        $permission->permission_widget = 'c';
        $permission->permission_level = '3';
        $permission->id_padre = 27;
        $permission->save();

    // (31, 'addRole', 'agregar rol', 'c', '3', 14, '2018-10-07 11:59:03', '2018-10-07 11:59:10'),
        $permission = new Permission;
        $permission->permission_name = 'addRole';
        $permission->permission_description = 'agregar rol';
        $permission->permission_widget = 'c';
        $permission->permission_level = '3';
        $permission->id_padre = 14;
        $permission->save();

    // (32, 'ediRole', 'editar rol', 'c', '3', 14, '2018-10-07 11:58:22', '2018-10-07 11:59:09'),
        $permission = new Permission;
        $permission->permission_name = 'ediRole';
        $permission->permission_description = 'editar rol';
        $permission->permission_widget = 'c';
        $permission->permission_level = '3';
        $permission->id_padre = 14;
        $permission->save();

    // (33, 'delRole', 'eliminar rol', 'c', '3', 14, '2018-10-07 11:59:06', '2018-10-07 11:59:07');
        $permission = new Permission;
        $permission->permission_name = 'delRole';
        $permission->permission_description = 'eliminar rol';
        $permission->permission_widget = 'c';
        $permission->permission_level = '3';
        $permission->id_padre = 14;
        $permission->save();

    }
}
