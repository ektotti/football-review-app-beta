<template>
    <div class="tactical-board-buttons col-12 mt-2">
        <div class="row justify-content-between">
            <div class="col-5 row justify-content-center">
                <button class="col-2 btn mr-2 btn-drawing" @click="_onClickRect">□</button>
                <button class="col-3 btn btn-drawing" @click="_onClickText">
                    テキスト
                </button>
                <button
                    class="btn btn-drawing ml-2 col-3"
                    @click="_onClickLine"
                    id="line"
                >
                    実線
                </button>
                <button
                    class="btn btn-danger ml-2 col-3"
                    @click="_onClickDelete"
                    id="delete"
                    disabled
                >
                    削除
                </button>
            </div>
            <div class="col-5 row justify-content-end">
                <button class="col-0.5 btn border mr-2">
                    <a class="text-black" href="/create/prepare">戻る</a>
                </button>
                <button class="col-2 btn border mr-2" @click="_changePlayers">
                    交代
                </button>
                <button v-if="isPost" class="col-3 btn border" @click="_onclick">
                    一時保存
                </button>
                <button v-if="!isPost" class="col-4 btn border" @click="_onclick">
                    ダウンロード
                </button>
                <button
                    v-if="isPost"
                    class="btn btn-primary next-button ml-2 col-3"
                >
                    <a href="/post/create" class="text-white">次へ</a>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:[
        "isPost",
        "refererPath",
    ],
    methods: {
        _onclick: function () {
            this.$emit("captureBoard");
        },
        _changePlayers: function () {
            this.$emit("_changePlayers");
        },
        _onClickText: function () {
            this.$emit("_onClickText");
        },
        _onClickRect: function () {
            this.$emit("_onClickRect");
        },
        _onClickLine: function () {
            this.$emit("_onClickLine");
        },
        _onClickDelete: function () {
            this.$emit("_onClickDelete");
        },
    },
};
</script>
