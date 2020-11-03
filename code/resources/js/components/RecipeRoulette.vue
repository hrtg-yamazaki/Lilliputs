<template>

    <div class="recipe-roulette">
        <div class="recipe-roulette__box">

            <div class="roulette-fields">
                <div class="roulette-field">
                    <div class="roulette-panel">
                        <div class="roulette-panel__text">
                            <i class="fas fa-question fa-5x"></i>
                        </div>
                    </div>
                </div>
                <p class="roulette-symbol">
                    <i class="fas fa-times fa-2x"></i>
                </p>
                <div class="roulette-field">
                    <div class="roulette-panel">
                        <div class="roulette-panel__text">
                            <i class="fas fa-question fa-5x"></i>
                        </div>
                    </div>
                </div>
            </div>

            <p class="half-border"></p>

            <div class="roulette-button">
                <a href="#" class="roulette-button__link">
                    スタート
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
