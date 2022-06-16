<template>
    <div class="tactical-board row flex-column align-items-center">
        <field
            ref="field"
            :selectedMatch="selectedMatch"
        ></field>
        <tactical-board-buttons
            @captureBoard="captureBoard"
            @_changePlayers="_changePlayers"
            @_onClickText="_onClickText"
            @_onClickRect="_onClickRect"
            @_onClickLine="_onClickLine"
            @_onClickDelete="_onClickDelete"
            :isPost="isPost"
        ></tactical-board-buttons>
    </div>
</template>
<script>
export default {
    props:[
        "isPost",
        "selectedMatch"
    ],
    data: function(){
        return {
            canvas: this.$refs,
        }
    },
    methods: {
        captureBoard: function () {
            this.$refs.field.capture();
        },
        _changePlayers: function () {
            this.$refs.field.$data.showModal=true;      
        },
        _onClickText: function() {
            this.$refs.field.$refs.canvas._onClickText();
        },
        _onClickRect: function() {
            this.$refs.field.$refs.canvas._onClickRect();
        },
        _onClickLine: function() {
            this.$refs.field.$refs.canvas._onClickLine();
        },
        _onClickDelete: function() {
            this.$refs.field.$refs.canvas._onClickDelete();
        }
    },
};
</script>
