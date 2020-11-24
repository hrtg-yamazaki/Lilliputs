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
                材料を追加
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
            }
        },
        methods: {
            addField: function(){
                console.log("add!");
            },
            removeField: function(){
                console.log("remove!");
            }
        },
        mounted() {
            const defaultField = {name: ""}
            this.processFields.push(defaultField);
        }
    }
</script>
