<template>
    <div class="main-content-warapper">
        <div class="main-content-inner row justify-content-end">
            <div class="row">
                <div class="slide col-8 px-0">
                    <post-image-carousel
                        :images="images"
                        :width="600"
                        :isCreate="true"
                    >
                    </post-image-carousel>
                </div>
                <div class="textcontent col-4 px-0">
                    <input type="hidden" name="_token" :value="csrf" />
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
            showModal: false,
        };
    },
    mounted: function () {
        this.setImagesFromSession();
        console.log(this.showModal);
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
                console.log(this.showModal);
                this.removeImagesFromSession();
            }
        },
        upLoadImages: function (e) {
            this.images = [];
            console.log(e.target.files);
            for (let key in e.target.files) {
                let reader = new FileReader();
                reader.readAsDataURL(e.target.files[key]);
                reader.onload = function (e) {
                    console.log("onload");
                    console.log(this);
                    let imageData = e.target.result;
                    console.log(imageData);
                    this.images.push(imageData);
                }.bind(this);
            }
        },
        setImagesFromSession: function () {
            for (let i = 1; i <= 4; i++) {
                if (sessionStorage.getItem(`image${i}`)) {
                    let imageData = sessionStorage.getItem(`image${i}`);
                    this.images.push(imageData);
                }
            }
        },
        removeImagesFromSession: function () {
            for (let i = 1; i <= 4; i++) {
                if (sessionStorage.getItem(`image${i}`)) {
                    sessionStorage.removeItem(`image${i}`);
                } else {
                    return;
                }
            }
        },
    },
    components: {
        PostImageCarousel,
        Modal,
    },
};
</script>
