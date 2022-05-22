<template>
    <div class="main-content-warapper">
        <div class="main-content-inner row">
            <div class="slide col-8">
                <post-image-carousel
                :images="images"
                :width="600">
                </post-image-carousel>
            </div>
            <div class="textcontent col-4">
                <input type="hidden" name="_token" :value="csrf" />
                <textarea v-model="textContent" cols="30" rows="10"></textarea>
                <button class="btn btn-primary" @click="sendForm" >投稿する</button>
            </div>
        </div>
        <!-- <portal to="modal"> -->
            <Modal
                :show="show"
                :modalContent="'CreatePostInfo'"
            >
            </Modal>
        <!-- </portal> -->
    </div>
</template>
<script>
import PortalVue from "portal-vue";
Vue.use(PortalVue);
import PostImageCarousel from "./PostImageCarousel.vue";
import Modal from "./Modal.vue";
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
            textContent: "レビューを書きましょう！",
            show: true,
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
                
            if(response.status == 200){
                console.log('naze:',response.status);
                this.show = true;
            }
        }
    },
    components: {
        PostImageCarousel,
        Modal,
    },
};
</script>
