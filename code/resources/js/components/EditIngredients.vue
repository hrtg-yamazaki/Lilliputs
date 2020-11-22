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
            <p class="ingredient-field__name">
                <input v-bind:name="'ingredients['+ i + '][name]'"
                        v-bind:value="ingredientFields[i]['name']"
                        type="text" class="ingredient-field__name__input">
            </p>
            <p class="ingredient-field__amount">
                <input v-bind:name="'ingredients['+ i + '][amount]'"
                        v-bind:value="ingredientFields[i]['amount']"
                        type="text" class="ingredient-field__amount__input">
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        props: ["ingredients"],
        data: function(){
            return {
                ingredientFields: []
            }
        },
        mounted() {
            this.ingredientFields = this.ingredients
            console.log(this.ingredientFields);
        }
    }
</script>
