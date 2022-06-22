<template>
    <div class="main-content-warapper">
        <div class="main-content-inner">
            <div class="row">
                <div class="slide col-8 px-0">
                    <post-image-carousel
                        :images="images"
                        :width="600"
                        :isIndex="false"
                        :isCreate="true"
                    >
                    </post-image-carousel>
                </div>
                <div class="textcontent col-4 px-0">
                    <input type="hidden" name="_token" :value="csrf" />
                    <input type="text" class="border-0 col-12 mb-2 py-2" v-model="title">
                    <textarea
                        v-model="textContent"
                        class="col-12 border-0"
                    ></textarea>
                </div>
            </div>
            <div class="mt-3">
                <label for="file_upload" class="mb-0">デバイスから選ぶ</label>
                <input
                    type="file"
                    name="file"
                    id="file_upload"
                    accept="image/*"
                    class="d-none"
                    @change="upLoadImages"
                    multiple
                />
                <button class="btn btn-primary ml-2" @click="sendForm">
                    投稿する
                </button>
            </div>
        </div>
        <portal to="modal">
            <Modal
                :showModal="showModal"
                :modalContent="'CreatePostInfo'"
            ></Modal>
        </portal>
    </div>
</template>
<script>
import PortalVue from "portal-vue";
Vue.use(PortalVue);
import PostImageCarousel from "./PostImageCarousel.vue";
import Modal from "./Modal.vue";
import axios from "axios";

export default {
    props: {
        csrf: {
            type: String,
            require: true,
        },
    },
    data: function () {
        return {
            images: [],
            textContent: "レビューを書きましょう！",
            title: "タイトル",
            showModal: false,
        };
    },
    mounted: function () {
        this.setImagesFromSession();
        if(this.images.length >= 4) {
            this.$el.querySelector('#file_upload').setAttribute('disabled');
        }
    },
    methods: {
        sendForm: async function () {
            axios.interceptors.request.use((request) => {
                console.log("Starting Request: ", request);
                return request;
            });
            let response = await axios.post("/post", {
                textContent: this.textContent,
                images: this.images,
            });

            if (response.status == 200) {
                this.showModal = true;
                this.removeImagesFromSession();
            }
        },
        upLoadImages: function (e) {
            let fileList = e.target.files;
            let imagesFromSession = JSON.parse(sessionStorage.getItem('images'));
            if(imagesFromSession.length + fileList.length > 4){
                alert("1度に投稿できる画像は4枚までです。");
                return;
            }
            for (let key in e.target.files) {
                let reader = new FileReader();
                reader.readAsDataURL(e.target.files[key]);
                reader.onload = function (e) {
                    this.images.push(e.target.result);
                }.bind(this);
            }
        },
        setImagesFromSession: function () {
            if(JSON.parse(sessionStorage.getItem('images'))){
                this.images = JSON.parse(sessionStorage.getItem('images'));
            } else {
                return;
            }
        },
        removeImagesFromSession: function () {
            if (sessionStorage.getItem('images')) {
                sessionStorage.removeItem('images');
            } else {
                return;
            }
        },
    },
    components: {
        PostImageCarousel,
        Modal,
    },
};
</script>
