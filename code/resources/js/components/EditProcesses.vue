<template>
    <div class="process-form__box">
        調理工程編集用フォーム
    </div>
</template>

<script>
    export default {
        props: ["processes"],
        mounted() {
            console.log(this.processes);
        }
    }
</script>
