<template>
    <div class="tactical-board-buttons col-12 mt-2">
        <div class="row justify-content-between py-1">
            <button class="col-2 btn btn-secondary">戻る</button>
            <div class="col-4 row justify-content-end">
            <button class="col-3 btn mr-2" @click="_changePlayers">選手交代</button>
            <button class="col-3 btn btn-success" @click="_onclick">保存する</button>
            <button v-if="isPost" class="btn btn-primary next-button ml-2 col-3"><a href="/post/create" class="text-white">次へ</a></button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:[
        "isPost",
    ],
    // mounted:function(){
    //     console.log(this.isPost);
    //     if(this.isPost == true) {
    //         let button = this.$el.querySelector('.next-button');
    //         button.classList.remove('d-none');
    //     }
    // },
    methods: {
        _onclick: function () {
            this.$emit("captureBoard");
        },
        _changePlayers: function() {
            console.log('クリック＠モーダル')
            this.$emit("_changePlayers");
        }
    },
};
</script>
