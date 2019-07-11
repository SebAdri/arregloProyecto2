<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(FamiliaRubroTableSeeder::class);
        $this->call(RubrosTableSeeder::class);
        $this->call(ClientesTableSeeder::class);
        $this->call(ObrasTableSeeder::class);
        $this->call(ProfesionesTableSeeder::class);
        $this->call(HerramientasTableSeeder::class);
        $this->call(MaquinariasTableSeeder::class);
        $this->call(MaterialesTableSeeder::class);
        // $this->call(PlanosTableSeeder::class);
        $this->call(TipoDocumentoTableSeeder::class);
        
    }
}
