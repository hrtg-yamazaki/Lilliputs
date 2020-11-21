<template>
    <div class="ingredient-form__box">
    </div>
</template>

<script>
    export default {
        props: ["ingredientFields"],
        mounted() {
            console.log(this.ingredientFields);
        }
    }
</script>
