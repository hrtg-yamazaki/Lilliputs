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
                    <input v-if="isset(processFields[i]['id'])"
                            type="hidden"
                            v-bind:name="'processes['+ i + '][id]'"
                            v-bind:value="processFields[i]['id']">
                    <textarea v-bind:name="'processes['+ i + '][content]'"
                                v-model="processFields[i]['content']"
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
        <ul v-if="isset(hiddenFields)" style="display: none;">
            <li v-for="(v, i) in hiddenFields" v-bind:key="i">
                <input type="hidden"
                        v-bind:value="v['id']"
                        v-bind:name="'processes['+ (i + processFields.length) +'][id]'">
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: ["processes"],
        data: function(){
            return {
                processFields: [],
                removeButtonState: "",
                hiddenFields: []
            }
        },
        methods: {
            addField: function(){
                /**
                 * Processフィールドの追加。
                 * 10フィールド以上の場合はアラートメッセージを送出。
                 */
                const nextField = {content: ""};
                if (this.processFields.length < 10) {
                    this.processFields.push(nextField);
                    if (this.processFields.length >= 2) {
                        this.removeButtonState = "";
                    }
                } else {
                    alert("調理工程は10項目以内でまとめてください")
                }
            },
            removeField: function(){
                /**
                 * Processフィールドの削除。
                 * 取り出したオブジェクトは、
                 * this.hideDefaultProcesses()によって選別される(後述)。
                 */
                var removingField = this.processFields.pop();
                this.hideDefaultProcesses(removingField);

                if (this.processFields.length <= 1) {
                    this.removeButtonState = "display: none;"
                }
            },
            isset: function(param){
                /**
                 * 汎用の、存在確認のための関数。
                 */
                if (param === "" || param === null || param == undefined || param == []) {
                    return false
                }
                return true
            },
            hideDefaultProcesses: function(removingField){
                /**
                 * 削除ボタンを押下したことによって抽出された、最後尾のフィールドにidがあるか判定。
                 * ある場合は、集合化と再配列化を行うことで重複確認をしたのち、
                 * バックエンド側から削除命令を送るためのhiddenFieldを生成する。
                 */
                if (this.isset(removingField["id"])){
                    this.hiddenFields.push(removingField);

                    var setHiddenField = new Set(this.hiddenFields);
                    this.hiddenFields = Array.from(setHiddenField);
                }
            }
        },
        mounted() {
            this.processFields = this.processes
            if (this.processFields.length <= 1){
                this.removeButtonState = "display: none;"
            }
        }
    }
</script>
