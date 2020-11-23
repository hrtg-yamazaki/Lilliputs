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
        <div v-for="i of formNumber" v-bind:key="i" class="ingredient-field clearfix">
            <p class="ingredient-field__name">
                <input class="ingredient-field__name__input" v-bind:name="'ingredients['+ (i - 1) + '][name]'" type="text">
            </p>
            <p class="ingredient-field__amount">
                <input class="ingredient-field__amount__input" v-bind:name="'ingredients['+ (i - 1) + '][amount]'" type="text">
            </p>
        </div>
        <div class="ingredient-button">
            <a v-on:click="addField" v-bind:style="addButtonState" class="ingredient-button__add">
                材料を追加
            </a>
            <a v-on:click="removeField" v-bind:style="removeButtonState" class="ingredient-button__remove">
                最終行を削除
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        data: function(){
            return {
                formNumber: 1,
                addButtonState: "",
                removeButtonState: "display: none;"
            }
        },
        methods: {
            addField: function(){
                if (this.formNumber < 20) {
                    this.formNumber += 1;
                } else {
                    alert("材料は20種類以内にまとめてください");
                }
                if (this.formNumber == 2) {
                    this.removeButtonState = "";
                }
            },
            removeField: function(){
                this.formNumber -= 1;
                if (this.formNumber == 1) {
                    this.removeButtonState = "display: none";
                } 
            }
        }
    }
</script>
