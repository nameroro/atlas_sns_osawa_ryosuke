<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('users') -> insert([
            [
                'username' => 'ルフィ',
                'mail' => 'luffy@mail.com',
                'password' => bcrypt('password'),
                'bio' => '船長',
            ],
            [
                'username' => 'ゾロ',
                'mail' => 'zoro@mail.com',
                'password' => bcrypt('password'),
                'bio' => '剣豪',
            ],
            [
                'username' => 'ナミ',
                'mail' => 'nami@mail.com',
                'password' => bcrypt('password'),
                'bio' => '航海士',
            ],
            [
                'username' => 'ウソップ',
                'mail' => 'usopp@mail.com',
                'password' => bcrypt('password'),
                'bio' => '狙撃手',
            ],
            [
                'username' => 'サンジ',
                'mail' => 'sanji@mail.com',
                'password' => bcrypt('password'),
                'bio' => '料理人',
            ],
            [
                'username' => 'チョッパー',
                'mail' => 'chopper@mail.com',
                'password' => bcrypt('password'),
                'bio' => '医者',
            ],
            [
                'username' => 'ロビン',
                'mail' => 'robin@mail.com',
                'password' => bcrypt('password'),
                'bio' => '考古学者',
            ],
            [
                'username' => 'フランキー',
                'mail' => 'franky@mail.com',
                'password' => bcrypt('password'),
                'bio' => '船大工',
            ],
            [
                'username' => 'ブルック',
                'mail' => 'brooke@mail.com',
                'password' => bcrypt('password'),
                'bio' => '音楽家',
            ],
            [
                'username' => 'ジンベエ',
                'mail' => 'jinbe@mail.com',
                'password' => bcrypt('password'),
                'bio' => '操舵手',
            ],

        ]);
    }
}
