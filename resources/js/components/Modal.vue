<template>
    <div class="modal-base row justify-content-center" v-show="show">
        <div class="modal-overlay text-center"></div>
        <component
            :is="modalContent"
            :relationList="relationList"
            @contentBtnClick="contentBtnClick"
        ></component>
    </div>
</template>

<script>
import SetPostions from "./SetPostions";
import CreatePostInfo from "./CreatePostInfo";
import RelationShipList from "./RelationshipList";
export default {
    props: {
        show: '',
        modalContent: '',
        relationList: []
    },
    methods: {
        contentBtnClick: function (...args) {
            this.$emit(
                "contentBtnClick",
                args[0],
            );
        },
    },
    components: {
        SetPostions,
        CreatePostInfo,
        RelationShipList
    },
};
</script>
