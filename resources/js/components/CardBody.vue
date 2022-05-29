<template>
    <div class="card-body">
        <div class="card-body-image">
            <post-image-carousel
                class="VueCarousel col-12 px-0"
                :images="post.images"
                :postId="post.id"
                :isIndex="isIndex"
            >
            </post-image-carousel>
        </div>
        <div class="card-body row my-2 align-items-center" v-if="isIndex">
            <i class="fa-regular fa-heart fa-lg mr-4"></i>
            <i class="fa-regular fa-comment fa-lg"></i>
        </div>
        <div class="card-body row my-2 align-items-center" v-if="!isIndex">
            <i class="fa-regular fa-heart fa-lg mr-4"></i>
            <i class="fa-regular fa-comment fa-lg mr-1"></i>
            <span>{{ post.comments.length }}</span>
        </div>
        <div class="card-body-text" v-if="!isIndex">
            <span>{{ post.body }}</span>
        </div>
        <button class="btn py-0 mt-4 px-0" @click="show=!show" >コメントを見る</button>
        <ul class="list-unstyled my-4" v-if="!isIndex" v-show="show">
            <li class="list-unstyled my-4" v-for="(comment, index) in post.comments" :key="index">
                <p class="mb-0">{{comment.user.name}}</p>
                <span>{{comment.body}}</span>
            </li>
        </ul>
    </div>
</template>
<script>
export default {
    props: {
        post: {},
        isIndex: false,
    },
    data: function() {
        return {
            show:false,
        }
    },
    // mounted: function() {
        
    // }
};
</script>
