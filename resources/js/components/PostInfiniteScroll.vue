<template>
    <div class="col-md-8">
        <div class="card" v-for="(post, index) in posts" :key="index">
            <div class="card-header">
                <div
                    class="card-header-inner row justify-content-between text-center"
                >
                    <span class="col-2">{{ post.user.name }}</span>
                    <h3 class="col-6">{{ post.title }}</h3>
                    <a
                        class="row justify-content-center"
                        :href="'/create/board/' + post.fixture.id"
                    >
                        <span class="col-3 text-center">{{
                            post.fixture.hometeam_name
                        }}</span>
                        <span class="col-3 text-center">VS</span>
                        <span class="col-3 text-center">{{
                            post.fixture.awayteam_name
                        }}</span>
                    </a>
                    <!-- <span class="col-4">{{post.fixture.hometeam_name}}vs{{post.fixture.awayteam_name}}</span> -->
                </div>
            </div>
            <div class="card-body">
                <div class="card-body-image">
                    <post-image-carousel :images="post.images" :width="600" :postId="post.id" :isIndex="true">
                    </post-image-carousel>
                </div>
                <!-- <div class="card-body-text">
                        <span>{{ post.body }}</span>
                    </div> -->
            </div>
            <div class="card-footer"></div>
        </div>
        <infinitLoading @infinite="infiniteHandler"></infinitLoading>
    </div>
</template>

<script>
import Axios from "axios";
import infinitLoading from "vue-infinite-loading";
import PostImageCarousel from "./PostImageCarousel.vue";

export default {
    data: function () {
        return {
            posts: [],
            page: 1,
        };
    },
    methods: {
        infiniteHandler: async function ($state) {
            let response = await Axios.get("/post?page=" + this.page);
            console.log(response);

            for (let PostObj of response.data.data) {
                PostObj.images = this.getImageName(PostObj);
                console.log(PostObj);
                this.posts.push(PostObj);
            }
            $state.loaded();
            this.page += 1;
        },
        getImageName: function ({ image1, image2, image3, image4 }) {
            let images = [image1, image2, image3, image4];
            let imagename = images.filter(function (value) {
                return value != null;
            }, images);
            return imagename;
        },
    },
    components: {
        infinitLoading,
        PostImageCarousel,
    },
};
</script>
