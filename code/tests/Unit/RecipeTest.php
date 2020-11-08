<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Database\QueryException;
use App\Recipe;

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
     * 全てのカラムが空では登録できない
     */
    public function testNotCreateRecipe()
    {
        $this->expectException(QueryException::class);

        $recipe = new Recipe();
        $recipe->save();
    }

}
