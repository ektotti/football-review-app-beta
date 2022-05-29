<template>
    <carousel :perPage="1"
    :navigationEnabled="true"
    :paginationEnabled="false"
    >
        <slide v-for="(image, index) in images" :key="index">
            <a :href="'/post/'+postId" v-if="!isCreate">
                <img
                    :src="image"
                    alt=""
                    class="col-12 px-0"
                />
            </a>
            <img
                    :src="image"
                    alt=""
                    class="col-12 px-0"
                    v-if="isCreate"
                />
        </slide>
    </carousel>
</template>
<script>
import { Carousel, Slide } from "vue-carousel";
export default {
    props: {
        images:[],
        isCreate:'',
        postId:'',
    },
    data: function() {
        return{
            show:false,
        }
    },
    components: {
        Carousel,
        Slide,
    },
    mounted: function(){
        if(this.postId != null){
            this.show = true;
        }
    }
};
</script>
