<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Recipe;

class ExampleTest extends TestCase
{
    /** 
    * 事前マイグレートとRecipeのレコード作成
    */
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan(
            'migrate --env=testing --database=sqlite_testing --force'
        );

        $recipe = self::newSampleRecipe();
        $recipe->save();
    }

    /**
     * トップページが正常に表示されるかどうかのテスト
     *
     * @return void
     */
    public function testToppageIsAvailable()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Recipeのサンプルオブジェクトの生成
     */
    private static function newSampleRecipe(){
        $recipe = new Recipe();
        $recipe->title = "サンプルレシピ";
        $recipe->description = "サンプル説明文";

        return $recipe;
    }

}
