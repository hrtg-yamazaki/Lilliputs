<template>
    <div class="process-form__box">
        <h3 class="process-form__box__head">
            作り方
        </h3>
        <div class="process-form__box__content">
            <div v-for="(p, i) in processFields" v-bind:key="i" class="process-field clearfix">
                <h4 class="process-field__head">
                    {{ i + 1 }}.
                </h4>
                <p class="process-field__input">
                    <textarea v-bind:name="'processes['+ i + '][content]'"
                                type="text" class="process-field__input__textarea">
                    </textarea>
                </p>
            </div>
        </div>
        <div class="process-button">
            <a v-on:click="addField" class="process-button__add">
                調理工程を追加
            </a>
            <a v-on:click="removeField" v-bind:style="removeButtonState" class="process-button__remove">
                最終行を削除
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        data: function(){
            return {
                processFields: [],
                removeButtonState: "display: none;"
            }
        },
        methods: {
            addField: function(){
                var nextField = {content: ""}
                if (this.processFields.length < 10){
                    this.processFields.push(nextField);
                } else {
                    alert("「作り方」の項目は10工程以下にまとめて下さい");
                }
                if (this.processFields.length >= 2) {
                    this.removeButtonState = "";
                }
            },
            removeField: function(){
                var removeField = this.processFields.pop()
                if (this.processFields.length <= 1){
                    this.removeButtonState = "display: none;"
                }
            }
        },
        mounted() {
            const defaultField = {content: ""}
            this.processFields.push(defaultField);
        }
    }
</script>
