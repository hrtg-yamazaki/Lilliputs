<template>

    <div class="category-search__box">

        <form @submit.prevent class="search-form">
            <div class="category-field">
                <label for="maingred" class="category-field__label">メイン食材</label>
                <select v-model="maingred" v-on:change="searchRecipesByCategory" class="category-field__select">
                    <option v-for="maingredOption in maingredList" v-bind:value="maingredOption.id" v-bind:key="maingredOption.id">
                        {{ maingredOption.name }}
                    </option>
                </select>
            </div>
            <div class="category-field">
                <label for="method" class="category-field__label">調理方法</label>
                <select v-model="method" v-on:change="searchRecipesByCategory" class="category-field__select">
                    <option v-for="methodOption in methodList" v-bind:value="methodOption.id" v-bind:key="methodOption.id">
                        {{ methodOption.name }}
                    </option>
                </select>
                <button type="submit" style="display: none">検索</button>
            </div>
        </form>

        <p class="half-border"></p>

        <div class="search-result" v-if="recipes.length >= 1">
            <p class="search-result__message">
                検索結果 {{ recipes.length }} 件
            </p>
            <ul class="recipe-list">

                <li v-for="recipe in recipes" v-bind:key="recipe.id" class="recipe-panel">
                    <a v-bind:href="'/recipes/' + recipe.id" class="recipe-panel__inner">

                        <div v-if="recipe.image" class="panel-image">
                            <img v-bind:src="getImageUrl(recipe.image)">
                        </div>
                        <div v-else class="panel-image">
                            <p class="no-image">
                                no image
                            </p>
                        </div>

                        <div class="panel-info">
                            <p class="panel-info__title">
                                {{ recipe.title }}
                            </p>
                            <p class="panel-info__property">
                                {{ getMaingredName(recipe.maingred_id) }} × {{ getMethodName(recipe.method_id) }}
                            </p>
                        </div>
                    </a>
                </li>

            </ul>
        </div>

    </div>

</template>

<script>
    export default {
        data: function(){
            return {
                recipes: [],
                maingred: 0,
                maingredList: [
                    {id: 0, name: "選択してください"},
                    {id: 2, name: "肉"},
                    {id: 3, name: "魚介類"},
                    {id: 4, name: "野菜"},
                    {id: 5, name: "卵"},
                    {id: 1, name: "その他"},
                ],
                method: 0,
                methodList: [
                    {id: 0, name: "選択してください"},
                    {id: 2, name: "焼く・炒める"},
                    {id: 3, name: "揚げる"},
                    {id: 4, name: "煮る・茹でる"},
                    {id: 5, name: "生"},
                    {id: 1, name: "その他"},
                ]
            }
        },
        methods: {
            searchRecipesByCategory: function(){
                var self = this;
                if (self.maingred == 0 && self.method == 0) {
                    self.recipes = [];
                } else {
                    var url = "/api/recipes/search/category?";
                    var maingredQuery = "maingred=" + self.maingred;
                    var methodQuery = "method=" + self.method;
                    axios.get(url + maingredQuery + "&" + methodQuery).then(function(res){
                        self.recipes = res.data.recipes;
                    })
                }
            },
            getMaingredName: function(maingred_id){
                var maingredName = this.maingredList.find((m)=>m.id===maingred_id).name;
                return maingredName;
            },
            getMethodName: function(method_id){
                var methodName = this.methodList.find((m)=>m.id===method_id).name;
                return methodName;
            },
            getImageUrl: function(recipeImage){
                // 環境条件の代わりに保存されているパスがhttpで始まるかで分岐
                if (!(recipeImage.startsWith("http"))) {
                    recipeImage = "/uploads/" + recipeImage
                }
                return recipeImage;
            }
        }
    }
</script>
