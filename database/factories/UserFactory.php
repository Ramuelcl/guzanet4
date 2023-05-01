<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Laravel\Jetstream\Features;
use App\Models\Team;

use App\Models\User;
use Spatie\Permission\Models\Role;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $linkFolder = $_SERVER['DOCUMENT_ROOT'];
        $storage_path = '/storage/app/public/images/avatars';

        $filePath = $linkFolder . $storage_path;
        // Storage::deleteDirectory($filePath);

        $name = $this->faker->lastName();
        $prename = $this->faker->unique()->firstName();

        $i = $this->faker->numberBetween($min = 0, $max = 6);
        $seps = ['.', '_'];
        if ($i == 0) {
            $email = "$name$prename";
        } elseif ($i == 1) {
            $email = "$prename$seps[0]$name";
        } elseif ($i == 2) {
            $email = "$name$seps[0]$prename";
        } elseif ($i == 3) {
            $email = "$prename$name";
        } elseif ($i == 4) {
            $email = "$name$seps[1]$prename";
        } elseif ($i == 5) {
            $email = "$prename$seps[1]$name";
        } else {
            $arr = [$name, $prename];
            $key = array_rand($arr, 1);
            $email =  $arr[$key];
        }

        $email = fncCambiaCaracteresEspeciales($email);

        // $avatar0 = $this->faker->image(
        //     $dir = asset($filePath),
        //     $width = 640,
        //     $height = 480,
        //     $category = getIniciales($prename . ' ' . $name), /* usado como texto sobre la imagen,default null */
        //     $fullPath = false,
        //     $randomize = true, // it's a no randomize images (default: `true`)
        //     $word = null, //it's a filename without path
        //     $gray = false,
        //     $format = 'png'
        // );

        $avatar1 = $this->faker->imageUrl(
            $width = 640,
            $height = 480,
            $category = getIniciales($prename . ' ' . $name),
            $randomize = false,
            $word = null,
            $gray = false
        );

        // dump($avatar1);
        //
        // TODO: registrar foto en directorio, no se queda, se borra sola inmediatamente
        $roles = Role::all()->pluck('name')->toArray();

        // varias opciones de Rol
        // $role = $this->faker->randomElements($roles, random_int(1, 3));
        // $role = in_array('guest', $role) ? ['guest'] : $role;

        // un solo Rol
        $role = $this->faker->randomElements($roles);

        // dump($role, $roles);
        return [
            'name' => $name . " " . $prename,
            // 'prename' => $prename,
            'email' => $email . '@' . $this->faker->freeEmailDomain(),
            'email_verified_at' => now(),
            'profile_photo_path' => $avatar1,
            'is_active' => $this->faker->boolean(80),
            // 'password' => Hash::make('password'),
            'role' => implode(',', $role),
            // 'role' => $roles[array_rand($roles, 1)],
            'password' => 'password', // al guardarse se encripta, ver modelo User.php (setPasswordAttribute)
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Indicate that the user should have a personal team.
     *
     * @return $this
     */
    public function withPersonalTeam()
    {
        if (!Features::hasTeamFeatures()) {
            return $this->state([]);
        }

        return $this->has(
            Team::factory()
                ->state(function (array $attributes, User $user) {
                    return ['name' => $user->name . '\'s Team', 'user_id' => $user->id, 'personal_team' => true];
                }),
            'ownedTeams'
        );
    }
}
