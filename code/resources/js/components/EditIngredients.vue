<template>
    <div class="ingredient-form__box">
        <h3 class="ingredient-form__box__head">
            必要なもの
        </h3>
        <div class="ingredient-form__box__secondhead clearfix">
            <h4 class="secondhead-name">
                <label>食材の名前</label>
            </h4>
            <h4 class="secondhead-amount">
                <label>数量</label>
            </h4>
        </div>
        <div v-for="(v, i) in ingredientFields" v-bind:key="i" class="ingredient-field clearfix">
            <input v-if="isset(ingredientFields[i]['id'])"
                    type="hidden"
                    v-bind:name="'ingredients['+ i + '][id]'"
                    v-bind:value="ingredientFields[i]['id']">
            <p class="ingredient-field__name">
                <input v-bind:name="'ingredients['+ i + '][name]'"
                        v-model="ingredientFields[i]['name']"
                        type="text" class="ingredient-field__name__input">
            </p>
            <p class="ingredient-field__amount">
                <input v-bind:name="'ingredients['+ i + '][amount]'"
                        v-model="ingredientFields[i]['amount']"
                        type="text" class="ingredient-field__amount__input">
            </p>
        </div>
        <div class="ingredient-button">
            <a v-on:click="addField" class="ingredient-button__add">
                材料を追加
            </a>
            <a v-on:click="removeField" v-bind:style="removeButtonState" class="ingredient-button__remove">
                最終行を削除
            </a>
        </div>
        <ul v-if="isset(hiddenFields)" style="">
            <li v-for="(v, i) in hiddenFields" v-bind:key="i">
                <input type="hidden"
                        v-bind:value="v['id']"
                        v-bind:name="'ingredients['+ (i + ingredientFields.length) +'][id]'">
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: ["ingredients"],
        data: function(){
            return {
                ingredientFields: [],
                removeButtonState: "",
                hiddenFields: []
            }
        },
        methods: {
            addField: function(){
                /**
                 * Ingredientフィールドの追加。
                 * 20フィールド以上の場合はアラートメッセージを送出。
                 */
                const nextField = {name: "", amount: ""}
                if (this.ingredientFields.length < 20) {
                    this.ingredientFields.push(nextField);
                    if (this.ingredientFields.length >= 2) {
                        this.removeButtonState = ""
                    }
                } else {
                    alert("材料は20種類以内にまとめて下さい")
                }
            },
            removeField: function(){
                /**
                 * Ingredientフィールドの削除。
                 * 取り出したオブジェクトは、
                 * this.hideDefaultIngredients()によって選別される(後述)。
                 */
                var removingField = this.ingredientFields.pop();
                this.hideDefaultIngredients(removingField);

                if (this.ingredientFields.length <= 1) {
                    this.removeButtonState = "display: none";
                }
            },
            isset: function(param){
                /**
                 * 汎用の、存在確認のための関数。
                 */
                if (param === "" || param === null || param == undefined || param == []) {
                    return false
                }
                return true
            },
            hideDefaultIngredients: function(removingField){
                /**
                 * 削除ボタンを押下したことによって抽出された、最後尾のフィールドにidがあるか判定。
                 * ある場合は、集合化と再配列化を行うことで重複確認をしたのち、
                 * バックエンド側から削除命令を送るためのhiddenFieldを生成する。
                 */
                if (this.isset(removingField["id"])){
                    this.hiddenFields.push(removingField);

                    var setHiddenField = new Set(this.hiddenFields);
                    this.hiddenFields = Array.from(setHiddenField);
                }
            }
        },
        mounted() {
            this.ingredientFields = this.ingredients
            if (this.ingredientFields.length <= 1) {
                this.removeButtonState = "display: none";
            }
        }
    }
</script>
