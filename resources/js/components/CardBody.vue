<template>
    <div class="card-body pb-0">
        <div class="card-body-image">
            <post-image-carousel
                class="VueCarousel col-12 px-0"
                :images="post.images"
                :postId="post.id"
                :isIndex="isIndex"
            >
            </post-image-carousel>
        </div>
        <div class="card-body row mt-2 align-items-center py-2" v-if="isIndex">
            <i class="fa-solid fa-heart fa-lg mr-1"></i>
            <span class="mr-4">{{ post.likes.length }}</span>
            <i class="fa-regular fa-comment fa-lg mr-1"></i>
            <span>{{ post.comments.length }}</span>
        </div>
        <div class="card-body row my-2 align-items-center py-2" v-if="!isIndex">
            <a :href="`/unlike/${post.id}`" v-if="likeThisPost">
                <i class="fa-solid fa-heart fa-lg mr-1"></i>
            </a>
            <a :href="`/like/${post.id}`" v-if="!likeThisPost">
                <i class="fa-regular fa-heart fa-lg mr-1"></i>
            </a>
            <span class="mr-3">{{ post.likes.length }}</span>
            <i class="fa-regular fa-comment fa-lg mr-1"></i>
            <span class="mr-3">{{ post.comments.length }}</span>
            <a href="" v-if="isSelf">
                <i class="fa-solid fa-pen-to-square fa-lg mr-3"></i>
            </a>
            <button class="btn" v-if="isSelf">
                <i class="fa-solid fa-trash fa-lg mr-1" @click="showModal=true"></i>
            </button>
        </div>
        <div class="card-body-text" v-if="!isIndex">
            <span>{{ post.body }}</span>
        </div>
        <button
            class="btn py-0 mt-4 mb-2 px-0"
            @click="show = !showComment"
            v-if="!isIndex"
        >
            コメントを見る
        </button>
        <ul class="list-unstyled my-4" v-if="!isIndex" v-show="showComment">
            <li
                class="list-unstyled my-4"
                v-for="(comment, index) in post.comments"
                :key="index"
            >
                <p class="mb-0">{{ comment.user.name }}</p>
                <span>{{ comment.body }}</span>
            </li>
        </ul>
        <portal to="modal">
            <Modal
                @contentBtnClick="showModal=false"
                :showModal="showModal"
                :modalContent="'DeletePost'"
                :args="{postId:post.id}"
                v-if="!isIndex"
            >
            </Modal>
        </portal>
    </div>
</template>
<script>
import Modal from "./Modal.vue";
import PortalVue from "portal-vue";
Vue.use(PortalVue);
export default {
    props: {
        post: {},
        isIndex: {
            type: Boolean,
            default: false,
        },
        likeThisPost: {
            type: Boolean,
        },
        isSelf: {
            type: Boolean,
        },
    },
    data: function () {
        return {
            showComment: false,
            showModal: false,
        };
    },
    components: {
        Modal,
    }
};
</script>
