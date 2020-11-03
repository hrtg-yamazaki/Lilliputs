<template>

    <div class="recipe-roulette">
        <div class="recipe-roulette__box">

            <div class="roulette-fields">
                <div class="roulette-field">
                    <div class="roulette-panel">
                        <div class="roulette-panel__text">
                            <i class="fas fa-carrot fa-5x"></i>
                        </div>
                    </div>
                </div>
                <p class="roulette-symbol">
                    <i class="fas fa-times"></i>
                </p>
                <div class="roulette-field">
                    <div class="roulette-panel">
                        <div class="roulette-panel__text">
                            煮る・茹でる
                        </div>
                    </div>
                </div>
            </div>

            <p class="half-border"></p>

            <div class="roulette-button">
                <a href="#" class="roulette-button__link">
                    候補を見る
                </a>
            </div>

        </div>
    </div>

</template>

<script>
    export default {
        mounted() {
            console.log('Roulette mounted.')
        }
    }
</script>
