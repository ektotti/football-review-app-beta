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
        <div class="card-body row mb-2 align-items-center py-2" v-if="!isIndex">
            <a
                class="text-body"
                :href="`/unlike/${post.id}`"
                v-if="likeThisPost"
            >
                <i class="fa-solid fa-heart fa-lg mr-1"></i>
            </a>
            <a
                class="text-body"
                :href="`/like/${post.id}`"
                v-if="!likeThisPost"
            >
                <i class="fa-regular fa-heart fa-lg mr-1"></i>
            </a>
            <span class="mr-3">{{ post.likes.length }}</span>
            <i class="fa-regular fa-comment fa-lg mr-1"></i>
            <span class="mr-3">{{ post.comments.length }}</span>
            <span class="text-body" href="" v-if="isSelf">
                <i
                    class="fa-solid fa-pen-to-square fa-lg mr-2"
                    @click="modifyMode=!modifyMode"
                ></i>
            </span>
            <button class="btn" v-if="isSelf">
                <i
                    class="fa-solid fa-trash fa-lg mr-1"
                    @click="showModal = true"
                ></i>
            </button>
        </div>
        <div class="card-body-text" v-if="!isIndex">
            <span v-if="!modifyMode">{{ post.body }}</span>
            <form
                class="d-flex col-12 px-0 align-self-start"
                :action="`/post/${post.id}`"
                method="POST"
                v-if="modifyMode"
            >
                <input type="hidden" name="_token" :value="csrf" />
                <input type="hidden" name="_method" value="PUT" />
                <textarea
                    class="col-11 border-0 form-control"
                    name="body"
                    id="floatingTextarea"
                    cols="10"
                    rows="2"
                > {{ post.body }} </textarea>
                <button type="submit" class="btn px-0 mx-auto">
                    <i class="fa-solid fa-paper-plane"></i>
                </button>
            </form>
        </div>
        <button
            class="btn py-0 mt-4 mb-2 px-0"
            @click="showComment = !showComment"
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
                @contentBtnClick="showModal = false"
                :showModal="showModal"
                :modalContent="'DeletePost'"
                :args="{ postId: post.id }"
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
            modifyMode: false,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        };
    },
    components: {
        Modal,
    },
};
</script>
