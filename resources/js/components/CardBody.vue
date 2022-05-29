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
        <div class="card-body-text" v-if="!isIndex">
            <span>{{ post.body }}</span>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        post: {},
        isIndex: false,
    },
};
</script>
