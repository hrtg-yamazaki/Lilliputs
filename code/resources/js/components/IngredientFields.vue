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
        <div class="ingredient-field clearfix">
            <p class="ingredient-field__name">
                <input class="ingredient-field__name__input" name="ingredients[0][name]" type="text">
            </p>
            <p class="ingredient-field__amount">
                <input class="ingredient-field__amount__input" name="ingredients[0][amount]" type="text">
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Ingredient form component is here.')
        }
    }
</script>
