<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Storage;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Storage::disk('public')->deleteDirectory('images/avatars');
        Storage::disk('public')->makeDirectory('images/avatars');

        /**
         * usando Storage
         * en tiempo  de ejecución
         *

        use Illuminate\Support\Facades\Storage;

        $disk = Storage::build([
            'driver' => 'local',
            'root' => '/path/to/root',
        ]);

        $disk->put('image.jpg', $content);
         **/

        /**
         * usando Storage
         **/
        // $folders=['images','icons', 'avatars', 'cursos','posts'];
        // foreach ($folders as $folder) {
        //     if (Storage::exists('\\public\\'.$folder)) {
        //         Storage::deleteDirectory('\\public\\'.$folder);
        //     }
        //     Storage::makeDirectory('\\public\\'.$folder);
        // }
        // Storage::disk('local')->put('example.txt', 'Contents 3221Contenido');// storage/app/
        // echo asset('local').'/file.txt ';

        // Storage::copy($folder, public_path().'banca.yaml');
        // dd(public_path(), storage_path(), public_path("storage"), storage_path('storage'), env('APP_URL').'/public/storage', $folders, $folder);

        $this->call([
            TablaSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
        ]);
    }
}
