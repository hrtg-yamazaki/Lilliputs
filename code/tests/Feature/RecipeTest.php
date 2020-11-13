<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Recipe;
use App\User;

class RecipeTest extends TestCase
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
     * ログイン状態であれば新規投稿ページへアクセスできる
     */
    public function testAccessCreateRecipeWithUser(){
        $user = User::latest()->first();

        $response = $this->actingAs($user)
                            ->withSession(["user_id" => $user->id])
                            ->get('/recipes/create');

        $response->assertStatus(200);
    }

    /**
     * 非ログイン状態では新規投稿ページへアクセスできず、ログインページへリダイレクトされる
     */
    public function testCannotAccessCreateRecipeWithoutUser(){
        $response = $this->get('/recipes/create');

        $response->assertRedirect("/login");
    }

    /**
     * ログイン状態であれば、自分で作成したレシピの編集ページへアクセスできる
     */
    public function testAccessEditRecipeWithAuthor(){
        $user = User::latest()->first();
        $recipe = Recipe::where("id", $user->id)->first();

        $response = $this->actingAs($user)
                            ->withSession(["user_id" => $user->id])
                            ->get('/recipes/'.$recipe->id.'/edit');

        $response->assertStatus(200);
    }

    /**
     * ログイン状態であっても、自分以外のユーザーが作成したレシピの編集ページへは403でアクセスできない
     */
    public function testCannotAccessEditRecipeWithNotAuthor(){
        $user = User::latest()->first();
        $recipe = self::createAnotherRecipe();

        $response = $this->actingAs($user)
                            ->withSession(["user_id" => $user->id])
                            ->get('/recipes/'.$recipe->id.'/edit');

        $response->assertStatus(403);
    }

    /**
     * 非ログイン状態では編集ページへアクセスできず、ログインページへリダイレクトされる
     */
    public function testCannotAccessEditRecipeWithoutUser(){
        $recipe = Recipe::latest()->first();

        $response = $this->get('/recipes/'.$recipe->id.'/edit');

        $response->assertRedirect("/login");
    }

    /**
     * ログイン状態であれば、自分で作成したレシピの削除確認ページへアクセスできる
     */
    public function testAccessDestroyConfirmWithAuthor(){
        $user = User::latest()->first();
        $recipe = Recipe::where("id", $user->id)->first();

        $response = $this->actingAs($user)
                            ->withSession(["user_id" => $user->id])
                            ->get('/recipes/'.$recipe->id.'/destroy');

        $response->assertStatus(200);
    }

    /**
     * ログイン状態であっても、自分以外のユーザーが作成したレシピの削除確認ページへは403でアクセスできない
     */
    public function testCannotAccessDestroyConfirmWithNotAuthor(){
        $user = User::latest()->first();
        $recipe = self::createAnotherRecipe();

        $response = $this->actingAs($user)
                            ->withSession(["user_id" => $user->id])
                            ->get('/recipes/'.$recipe->id.'/destroy');

        $response->assertStatus(403);
    }

    /**
     * 非ログイン状態では削除確認ページへアクセスできず、ログインページへリダイレクトされる
     */
    public function testCannotAccessDestroyConfirmWithoutUser(){
        $recipe = Recipe::latest()->first();

        $response = $this->get('/recipes/'.$recipe->id.'/destroy');

        $response->assertRedirect("/login");
    }

    /**
     * ログイン状態であれば、自分で作成したレシピの削除ページへアクセスできる
     */
    public function testAccessDestroyRecipeWithAuthor(){
        $user = User::latest()->first();
        $recipe = Recipe::where("id", $user->id)->first();
        $recipeId = $recipe->id;

        $response = $this->actingAs($user)
                            ->withSession(["user_id" => $user->id])
                            ->delete('/recipes/'.$recipe->id);

        $this->assertDeleted("recipes", ["id"=>$recipeId]);
        $response->assertRedirect("/");
    }

    /**
     * ログイン状態であっても、自分以外のユーザーが作成したレシピの削除ページへは403でアクセスできない
     */
    public function testCannotAccessDestroyRecipeWithNotAuthor(){
        $user = User::latest()->first();
        $recipe = self::createAnotherRecipe();

        $response = $this->actingAs($user)
                            ->withSession(["user_id" => $user->id])
                            ->delete('/recipes/'.$recipe->id);

        $response->assertStatus(403);
    }

    /**
     * 非ログイン状態では削除確認ページへアクセスできず、ログインページへリダイレクトされる
     */
    public function testCannotAccessDestroyRecipeWithoutUser(){
        $recipe = Recipe::latest()->first();

        $response = $this->delete('/recipes/'.$recipe->id);

        $response->assertRedirect("/login");
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
    private static function newSampleRecipe($user){
        $recipe = new Recipe();
        $recipe->title = "サンプルレシピ";
        $recipe->description = "サンプル説明文";
        $recipe->user_id = $user->id;

        return $recipe;
    }

    /**
     * 「別のUserのRecipe」のサンプル「レコード」の生成
     */
    private static function createAnotherRecipe(){
        $recipe = new Recipe();
        $recipe->title = "サンプルレシピ２";
        $recipe->description = "サンプル説明文２";
        $recipe->user_id = 256;

        $recipe->save();
        return $recipe;
    }

}



