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
            <span class="mr-4">{{ post.likes.length }}</span>
            <i class="fa-regular fa-comment fa-lg mr-1"></i>
            <span>{{ post.comments.length }}</span>
        </div>
        <div class="card-body-text" v-if="!isIndex">
            <span>{{ post.body }}</span>
        </div>
        <button class="btn py-0 mt-4 mb-2 px-0" @click="show = !show" v-if="!isIndex">
            コメントを見る
        </button>
        <ul class="list-unstyled my-4" v-if="!isIndex" v-show="show">
            <li
                class="list-unstyled my-4"
                v-for="(comment, index) in post.comments"
                :key="index"
            >
                <p class="mb-0">{{ comment.user.name }}</p>
                <span>{{ comment.body }}</span>
            </li>
        </ul>
    </div>
</template>
<script>
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
    },
    data: function () {
        return {
            show: false,
        };
    },
};
</script>
