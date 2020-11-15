<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Recipe;


class SearchTest extends TestCase
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
     * 検索TOPページへのアクセステスト
     */
    public function testAccessSearchTop()
    {
        $response = $this->get('/recipes/search/top');

        $response->assertStatus(200);
    }

    /**
     * タイトル検索ページへのアクセステスト(クエリなし)
     */
    public function testAccessSearchTitle()
    {
        $response = $this->get('/recipes/search/title');

        $response->assertStatus(200);
    }

    /**
     * タイトル検索ページへのアクセステスト(キーワードあり・該当レコードあり)
     */
    public function testAccessSearchTitleWithKeyword()
    {
        $query = ["title"=>"プルレ"];
        $response = $this->call("GET", '/recipes/search/title', $query);

        $response->assertStatus(200);
        $response->assertSeeText("サンプルレシピ");
    }

    /**
     * タイトル検索ページへのアクセステスト(キーワードあり・該当レコードなし)
     */
    public function testAccessSearchTitleWithKeywordNotRecorded()
    {
        $query = ["title"=>"nothings"];
        $response = $this->call("GET", '/recipes/search/title', $query);

        $response->assertStatus(200);
        $response->assertSeeText("検索結果 ( 0 件 )");
    }

    /**
     * カテゴリ検索ページへのアクセステスト
     */
    public function testAccessSearchCategory()
    {
        $response = $this->get('/recipes/search/category');

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
