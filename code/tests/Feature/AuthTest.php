<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\User;


class AuthTest extends TestCase
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
     * ログインページへのアクセス
     */
    public function testAccessLogin()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    /** 
     * ログインのテスト
     */
    public function testLogin()
    {
        $user = self::createSampleUser();
        $this->actingAs($user)
            ->withSession(["user_id" => $user->id])
            ->get("/");

        $this->assertAuthenticated();
    }


    /**
     * サンプルユーザーの作成
     */
    private static function createSampleUser()
    {
        $user = new User();
        $user->name = "サンプルユーザー";
        $user->email = "sample@sample.com";
        $user->password = "samplepassword";

        $user->save();
        return $user;
    }

}
