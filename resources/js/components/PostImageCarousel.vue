<template>
    <carousel :perPage="1">
        <slide v-for="(image, index) in images" :key="index">
            <img
                :src="image"
                alt=""
                width="600"
            />
        </slide>
    </carousel>
</template>
<script>
import { Carousel, Slide } from "vue-carousel";
export default {
    data: function () {
        return {
            images: [],
        };
    },
    mounted: function () {
        for (let i = 1; i <= 4; i++) {
            if (sessionStorage.getItem(`image${i}`)) {
                let imageData = sessionStorage.getItem(`image${i}`);
                this.images.push(imageData);
            }
        }
    },
    components: {
        Carousel,
        Slide,
    },
};
</script>
