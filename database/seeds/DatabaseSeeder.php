<?php

use App\Models\Field;
use App\Models\Player;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);
        $field = Field::create();

            for($i = 0; $i < Config::get('settings.players'); $i++){
                $player = Player::create();
                $field->addPlayer($player);
            }

        Model::reguard();
    }
}
