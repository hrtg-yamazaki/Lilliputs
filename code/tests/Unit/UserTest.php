<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Database\QueryException;
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

    /**
     * 空のユーザーは登録できない
     */
    public function testNotCreateEmptyUser()
    {
        $this->expectException(QueryException::class);

        $user = new User();
        $user->save();
    }

    /**
     * nameが空のユーザーは登録できない
     */
    public function testNotCreateUserWithoutName()
    {
        $this->expectException(QueryException::class);

        $user = new User();
        $user->email = "sample2@sample.com";
        $user->password = "samplepassword2";

        $user->save();
    }

    /**
     * emailが空のユーザーは登録できない
     */
    public function testNotCreateUserWithoutEmail()
    {
        $this->expectException(QueryException::class);

        $user = new User();
        $user->name = "サンプルユーザー３";
        $user->password = "samplepassword3";

        $user->save();
    }

    /**
     * passwordが空のユーザーは登録できない
     */
    public function testNotCreateUserWithoutPassword()
    {
        $this->expectException(QueryException::class);

        $user = new User();
        $user->name = "サンプルユーザー４";
        $user->email = "sample2@sample.com";

        $user->save();
    }



}
