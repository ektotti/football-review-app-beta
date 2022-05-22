<template>
    <div class="tactical-board row flex-column align-items-center">
        <field
            ref="field"
        ></field>
        <tactical-board-buttons
            @captureBoard="captureBoard"
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
    },
};
</script>
