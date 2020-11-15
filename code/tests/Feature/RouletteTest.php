<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Recipe;
use App\User;

class RouletteTest extends TestCase
{

    /** 
     * 事前マイグレートとサンプルユーザー、サンプルレシピの作成
    */
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan(
            'migrate --env=testing --database=sqlite_testing --force'
        );

        $user = self::newSampleUser();
        $user->save();
        $recipe = self::newSampleRecipe($user);
        $recipe->save();
    }

    /**
     * 「ルーレット」開始ページが正常に表示されるかどうかのテスト
     */
    public function testRouletteReadyPageIsAvailable()
    {
        $response = $this->get('/recipes/roulette/ready');

        $response->assertStatus(200);
    }

    /**
     * private
     */

    /**
     * サンプルユーザーの作成
     */
    private static function newSampleUser()
    {
        $user = new User();
        $user->name = "サンプルユーザー";
        $user->email = "sample@sample.com";
        $user->password = "samplepassword";

        return $user;
    }

    /**
     * Recipeのサンプルオブジェクトの生成
     */
    private static function newSampleRecipe($user)
    {
        $recipe = new Recipe();
        $recipe->title = "サンプルレシピ";
        $recipe->description = "サンプル説明文";
        $recipe->user_id = $user->id;

        return $recipe;
    }
}
