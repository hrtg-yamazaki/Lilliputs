<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Database\QueryException;
use App\Recipe;
use App\User;

class RecipeTest extends TestCase
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
     * タイトル、説明文があれば登録できる
     */
    public function testCreateRecipe()
    {
        $recipe = new Recipe();
        $recipe->title = "サンプル";
        $recipe->description = "サンプルレシピ";
        $recipe->save();

        $expected = 1;
        $actual = Recipe::latest()->first()->id;

        $this->assertSame($expected, $actual);
    }

    /**
     * 全てのカラムがnullでは登録できない
     */
    public function testNotCreateRecipe()
    {
        $this->expectException(QueryException::class);

        $recipe = new Recipe();
        $recipe->save();
    }

    /**
     * 説明文があってもタイトルがnullでは登録できない
     */
    public function testCreateRecipeWithoutTitle(){
        $this->expectException(QueryException::class);

        $recipe = self::createSampleRecipe();
        $recipe->title = null;

        $recipe->save();
    }

    /**
     * タイトルがあっても説明文がnullでは登録できない
     */
    public function testCreateRecipeWithoutDescription(){
        $this->expectException(QueryException::class);

        $recipe = self::createSampleRecipe();
        $recipe->description = null;

        $recipe->save();
    }

    /**
     * user_idが数字であれば登録できる
     */
    public function testCreateRecipeWithUserId(){
        $recipe = self::createSampleRecipe();

        $recipe->user_id = 1;
        $recipe->save();

        $this->assertTrue(isset($recipe->id));
    }

    /**
     * maingred_idが数字であれば登録できる
     */
    public function testCreateRecipeWithMaingredId(){
        $recipe = self::createSampleRecipe();

        $recipe->maingred_id = 1;
        $recipe->save();

        $this->assertTrue(isset($recipe->id));
    }

    /**
     * method_idが数字であれば登録できる
     */
    public function testCreateRecipeWithMethodId(){
        $recipe = self::createSampleRecipe();

        $recipe->method_id = 1;
        $recipe->save();

        $this->assertTrue(isset($recipe->id));
    }

    /**
     * testCreateRecipeの結果に基づき、
     * 同じ内容のRecipeモデルオブジェクトを生成する関数
     */
    private static function createSampleRecipe(){
        $recipe = new Recipe();
        $recipe->title = "サンプル";
        $recipe->description = "サンプルレシピ";

        return $recipe;
    }

}
