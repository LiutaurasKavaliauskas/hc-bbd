<?php

namespace interactivesolutions\honeycombacl\database\seeds;


use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use interactivesolutions\honeycombacl\app\models\HCUsers;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $list = [
            ['email' => 'admin@hc.dev', 'password' => Hash::make('labas'), 'activated_at' => '2017-04-01']
        ];

        DB::beginTransaction ();

        try {
            foreach ($list as $userData) {
                $user = HCUsers::where ('email', $userData['email'])->first ();

                if (!$user)
                {
                    $record = HCUsers::create ($userData);
                    $record->roleSuperAdmin();
                }
            }
        } catch (\Exception $e) {
            DB::rollback ();

            throw new Exception($e->getMessage ());
        }

        DB::commit ();
    }
}