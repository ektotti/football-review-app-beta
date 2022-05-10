<template>
    <div class="tactical-board-buttons col-8">
        <div class="row justify-content-between">
            <button class="col-2">戻る</button>
            <button class="col-2" @click="_onclick">保存する</button>
        </div>
    </div>
</template>

<script>
export default {
    methods: {
        _onclick: function () {
            console.log("tactical発火");
            this.$emit("captureBoard");
        },
    },
};
</script>
