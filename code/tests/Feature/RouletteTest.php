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
     * 「ルーレット」結果ページが正常に表示されるかどうかのテスト
     */
    public function testRouletteResultPageIsAvailable()
    {
        $response = $this->get('/recipes/roulette/result');

        $response->assertStatus(200);
    }

    /**
     * 「ルーレット」結果ページへのアクセステスト(クエリあり・該当レコードあり)
     */
    public function testRouletteResultWithQuery()
    {
        $query = [
            "maingred_id" => 1,
            "method_id" => 1
        ];
        $response = $this->call("GET", '/recipes/roulette/result', $query);

        $response->assertStatus(200);
        $response->assertSeeText("サンプルレシピ");
    }

    /**
     * 「ルーレット」結果ページへのアクセステスト(クエリあり・該当レコードなし)
     */
    public function testRouletteResultWithNotRecorded()
    {
        $query = [
            "maingred_id" => 2,
            "method_id" => 2
        ];
        $response = $this->call("GET", '/recipes/roulette/result', $query);

        $response->assertStatus(200);
        $response->assertSeeText("現在条件にマッチするレシピはありません");
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
