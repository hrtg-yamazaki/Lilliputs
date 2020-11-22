<template>
    <div class="ingredient-form__box">
        
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
