<template>

    <div class="recipe-roulette">
        <div class="recipe-roulette__box">

            <div class="roulette-fields">
                <div class="roulette-field">
                    <div class="roulette-panel">
                        <div class="roulette-panel__text">
                            <i class="fas fa-5x" v-bind:class="'fa-' + getMaingredIcon(maingredId)"></i>
                        </div>
                    </div>
                </div>
                <p class="roulette-symbol">
                    <i class="fas fa-times fa-2x"></i>
                </p>
                <div class="roulette-field">
                    <div class="roulette-panel">
                        <div class="roulette-panel__text">
                            <i v-if="methodId === 0" class="fas fa-question fa-5x"></i>
                            <span v-else>{{ getMethodName(methodId) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <p class="half-border"></p>

            <div class="roulette-submit">
                <a v-on:click="startRoulette" class="roulette-button" v-bind:class="startButton">
                    {{ startString }}
                </a>
                <a v-on:click="stopRoulette" class="roulette-button" v-bind:class="stopButton">
                    ルーレットを止める
                </a>
            </div>

            <form class="roulette-form" v-bind:class="submitForm">
                <p class="half-border"></p>
                <div class="roulette-submit">
                    <button type="submit" class="roulette-button">
                        レシピの候補を見る
                    </button>
                </div>
            </form>

        </div>
    </div>

</template>

<script>
    export default {
        data: function(){
            return{
                startString: "ルーレットを回す",
                startButton: "",
                stopButton: "js-hidden-button",
                submitForm: "js-hidden-form",
                maingredId: 0,
                methodId: 0,
                rouletteRunning: false,
                maingredIcons: [
                    {id: 0, name: "question"},
                    {id: 2, name: "drumstick-bite"},
                    {id: 3, name: "fish"},
                    {id: 4, name: "carrot"},
                    {id: 5, name: "egg"}
                ],
                methodList: [
                    {id: 2, name: "焼く・炒める"},
                    {id: 3, name: "揚げる"},
                    {id: 4, name: "煮る・茹でる"},
                    {id: 5, name: "生"},
                ]
            }
        },
        methods: {
            startRoulette: function(){
                this.startButton = "js-hidden-button";
                this.stopButton = "";
                this.submitForm = "js-hidden-form";
                this.rouletteRunning = true;

                this.maingredId = Math.round(Math.random() * 3) + 2;
                this.methodId = Math.round(Math.random() * 3) + 2;
                console.log(this.maingredId + " & " + this.methodId);

                setTimeout(() => {
                    if (this.rouletteRunning === true) {
                        this.startRoulette();
                    }
                }, 32);
            },
            stopRoulette: function() {
                this.startString = "もう一度回す";
                this.startButton = "";
                this.stopButton = "js-hidden-button";
                this.submitForm = "";

                this.rouletteRunning = false;
            },
            getMaingredIcon: function(maingredId) {
                var iconName = this.maingredIcons.find((m)=>m.id===maingredId).name;
                return iconName;
            },
            getMethodName: function(methodId) {
                var methodName = this.methodList.find((m)=>m.id===methodId).name;
                return methodName;
            }
        }
    }
</script>
