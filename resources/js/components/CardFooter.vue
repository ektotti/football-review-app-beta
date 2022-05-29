<template>
    <div class="card-footer">
        <div class="card-body row" v-if="isIndex">
            <i class="fa-regular fa-heart fa-lg mr-4"></i>
            <i class="fa-regular fa-comment fa-lg"></i>
        </div>
        <div class="card-body row" v-if="!isIndex">
            <i class="fa-regular fa-heart fa-lg mr-4" @click="clickLikesButton"></i>
            <i class="fa-regular fa-comment fa-lg"></i>
        </div>
    </div>
</template>
<script>
import Axios from 'axios';
export default {
    props: {
        post: {},
        isIndex:{
            type: Boolean,
            default: false,
        }
    },
    methods: {
        // clickLikesButton: async function(event) {
        //     $response = await Axios.post('/likes', this.post);

        // },
    }
};
</script>
