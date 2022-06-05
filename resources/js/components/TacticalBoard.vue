<template>
    <div class="tactical-board row flex-column align-items-center">
        <field
            ref="field"
        ></field>
        <tactical-board-buttons
            @captureBoard="captureBoard"
            @_changePlayers="_changePlayers"
            :isPost="isPost"
        ></tactical-board-buttons>
    </div>
</template>
<script>
export default {
    props:[
        "isPost",
    ],
    methods: {
        captureBoard: function () {
            this.$refs.field.capture();
        },
        _changePlayers: function () {
            console.log('クリックされています');
            this.$refs.field.$data.show=true;
            
        },
    },
};
</script>
