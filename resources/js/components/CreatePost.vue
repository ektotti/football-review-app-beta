<template>
    <div class="main-content-warapper">
        <div class="main-content-inner row">
            <div class="slide col-8">
                <post-image-carousel></post-image-carousel>
            </div>
            <div class="textcontent col-4">
                <input type="hidden" name="_token" :value="csrf" />
                <textarea v-model="textContent" cols="30" rows="10"></textarea>
                <button class="btn btn-primary" @click="sendForm" >投稿する</button>
            </div>
        </div>
        <modal></modal>
    </div>
</template>
<script>
import PostImageCarousel from "./PostImageCarousel.vue";
import axios from "axios";

export default {
    props:{
        csrf:{
            type:String,
            require:true,
        },
    },
    data: function () {
        return {
            images: [],
            textContent: "レビューを書きましょう！"
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
    methods: {
        sendForm: async function(){
            axios.interceptors.request.use(request => {
                console.log('Starting Request: ', request)
                return request
            });
            let response = await axios.post('/post',{
                'textContent' : this.textContent,
                'images' : this.images});
            if(response.status === 200){
                alert('投稿しました。');
                console.log(response);
            }
        }
    },
    components: {
        PostImageCarousel,
    },
};
</script>
