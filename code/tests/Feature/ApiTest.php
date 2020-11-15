<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Recipe;
use App\User;

class ApiTest extends TestCase
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
     * Recipeカテゴリ検索用APIのjsonテスト(クエリあり、レコードあり)
     */
    public function testSearchApiWithRecordedQuery()
    {
        $query = ["maingred"=>1, "method"=>1];
        $response = $this->call("GET", '/api/recipes/search/category', $query);

        $response->assertJson([
            "recipes"=>[[
                "title" => "サンプルレシピ",
                "description" => "サンプル説明文"
            ]]
        ]);
    }

    /**
     * Recipeカテゴリ検索用APIのjsonテスト(クエリあり、レコードなし)
     */
    public function testSearchApiWithNotRecordedQuery()
    {
        $query = ["maingred"=>2, "method"=>2];
        $response = $this->call("GET", '/api/recipes/search/category', $query);

        $response->assertJson([
            "recipes" => []
        ]);
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
