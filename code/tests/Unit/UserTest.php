<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;


class UserTest extends TestCase
{

    /**
     * 事前マイグレート
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan(
            'migrate --env=testing --database=sqlite_testing --force'
        );
    }

    /**
     * name, email, passwordがあれば登録できる
     */
    public function testCreateUser()
    {
        $user = new User();
        $user->name = "サンプルユーザー";
        $user->email = "sample1@sample.com";
        $user->password = "samplepassword";

        $this->assertTrue($user->save());
    }

}
