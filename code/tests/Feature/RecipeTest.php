<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecipeTest extends TestCase
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
     * 指定したidのRecipeレコードがある時、レシピ詳細ページが正常に表示されるかどうかのテスト
     *
     * @return void
     */
    public function testShowRecipeIsAvailableWithRecord()
    {
        $recipe = Recipe::latest()->first();
        $response = $this->get('/recipes/'.$recipe->id);

        $response->assertStatus(200);
    }

    /**
     * 指定したidのRecipeレコードがない時、レシピ詳細ページが正常に表示されないことのテスト
     *
     * @return void
     */
    public function testShowRecipeIsNotAvailableWithoutRecord()
    {
        $recipe = Recipe::latest()->first();
        $response = $this->get('/recipes/999');

        $response->assertStatus(404);
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
