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
     * ログアウトのテスト
     */
    public function testLogout()
    {
        $user = self::createSampleUser();
        $this->actingAs($user)
            ->withSession(["user_id" => $user->id])
            ->get("/");

        $this->post("/logout");
        $this->assertGuest();
    }

    /**
     * 新規登録ページへのアクセス
     */
    public function testAccessRegister()
    {
        $response = $this->get("/register");

        $response->assertStatus(200);
    }

    /**
     * 新規登録のテスト(DB、送信後リダイレクト)
     */
    public function testRegister()
    {
        $formData = [
            "name"=>"サンプルユーザー２",
            "email"=>"sample2@sample.com",
            "password"=>"samplepassword2",
            "password_confirmation"=>"samplepassword2"
        ];
        $response = $this->from("register")
                        ->post("register", $formData);

        $this->assertDatabaseHas("users", ["name"=>"サンプルユーザー２"]);
        $response->assertRedirect("/");
    }

    /**
     * 不足する要素があると新規登録できず再表示される
     */
    // name
    public function testFailToRegisterWithoutName()
    {
        $formData = [
            "email"=>"sample3@sample.com",
            "password"=>"samplepassword3",
            "password_confirmation"=>"samplepassword3"
        ];
        $response = $this->from("register")
                        ->post("register", $formData);

        $response->assertRedirect("/register");
    }
    // email
    public function testFailToRegisterWithoutEmail()
    {
        $formData = [
            "name"=>"サンプルユーザー３",
            "password"=>"samplepassword3",
            "password_confirmation"=>"samplepassword3"
        ];
        $response = $this->from("register")
                        ->post("register", $formData);

        $response->assertRedirect("/register");
    }
    // password
    public function testFailToRegisterWithoutPassword()
    {
        $formData = [
            "name"=>"サンプルユーザー３",
            "email"=>"sample3@sample.com",
            "password_confirmation"=>"samplepassword3"
        ];
        $response = $this->from("register")
                        ->post("register", $formData);

        $response->assertRedirect("/register");
    }
    // password_confirmation
    public function testFailToRegisterWithoutPasswordConfirmation()
    {
        $formData = [
            "name"=>"サンプルユーザー３",
            "email"=>"sample3@sample.com",
            "password"=>"samplepassword3",
        ];
        $response = $this->from("register")
                        ->post("register", $formData);

        $response->assertRedirect("/register");
    }


    /**
     * private
     */

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
