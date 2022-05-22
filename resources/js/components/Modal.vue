<template>
    <div class="modal-base row justify-content-center" v-show="show">
        <div class="modal-overlay text-center"></div>
        <component
            :is="modalContent"
            @contentBtnClick="contentBtnClick"
        ></component>
    </div>
</template>

<script>
import SetPostions from "./SetPostions";
import CreatePostInfo from "./CreatePostInfo";
export default {
    props: {
        show: '',
        modalContent: '',
    },
    methods: {
        contentBtnClick: function (...args) {
            console.log('modal',args);
            this.$emit(
                "contentBtnClick",
                args[0],
            );
        },
    },
    components: {
        SetPostions,
        CreatePostInfo
    },
};
</script>
