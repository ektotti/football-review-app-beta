<template>
    <div class="tactical-board-buttons col-10">
        <div class="row justify-content-between py-1">
            <button class="col-2 btn btn-secondary">戻る</button>
            <div class="col-4 row justify-content-end">
            <button class="col-6 btn btn-success" @click="_onclick">保存する</button>
            <button class="next-button d-none col-6"><a href="/post/create">次へ</a></button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:[
        "isPost",
    ],
    mounted:function(){
        console.log(this.isPost);
        if(this.isPost == true) {
            let button = this.$el.querySelector('.next-button');
            button.classList.remove('d-none');
        }
    },
    methods: {
        _onclick: function () {
            this.$emit("captureBoard");
        },
    },
};
</script>
