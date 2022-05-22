<template>
    <carousel :perPage="1">
        <slide v-for="(image, index) in images" :key="index">
            <a :href="'/post/'+postId" v-if="isIndex">
                <img
                    :src="'/storage/'+image"
                    alt=""
                    :width="width"
                />
            </a>
            <img
                    :src="image"
                    alt=""
                    :width="width"
                    v-if="!isIndex"
                />
        </slide>
    </carousel>
</template>
<script>
import { Carousel, Slide } from "vue-carousel";
export default {
    props: {
        images:[],
        width:'',
        isIndex:'',
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
