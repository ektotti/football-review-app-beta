<template>
    <div class="profiel-wrapper col-12">
        <div
            class="profiel-inner row col-8 justify-content-center mx-auto py-3"
        >
            <div class="profiel-inner-icon col-4">
                <img
                    class="rounded"
                    src="/storage/sample.jpg"
                    alt="Icon"
                    width="150"
                />
            </div>
            <div class="profiel-inner-content col-8">
                <div class="upside row py-2 align-items-center">
                    <h2 class="mr-5 mb-0">{{ selectedUser.name }}</h2>
                    <div v-show="!isSelf">
                        <button
                            class="btn btn-primary mr-5"
                            @click="followUser"
                            v-if="!isFollowing"
                        >
                            フォローする
                        </button>
                        <button
                            class="btn btn-primary mr-5"
                            @click="unfollowUser"
                            v-if="isFollowing"
                        >
                            フォローをやめる
                        </button>
                    </div>
                    <div v-show="isSelf">
                        <a :href="`/user/${selectedUser.id}/edit`" class="btn btn-primary">
                            プロフィール編集
                        </a>
                        <a :href="`/logout`" class="btn btn-primary">
                            ログアウト
                        </a>
                    </div>
                </div>
                <div class="under-side row py-4">
                    <span class="h4 mr-5 mb-0" href="">投稿</span>
                    <div class="h4 mr-5 mb-0" @click="showFollows">
                        <span> {{ followingUserAmount }} </span>
                        <span> フォロー </span>
                    </div>
                    <div class="h4 mr-5 mb-0" @click="showFollowers">
                        <span> {{ followedUserAmount }} </span>
                        <span> フォロワー </span>
                    </div>
                </div>
            </div>
        </div>
        <portal to="modal">
            <Modal
                @contentBtnClick="show = false"
                :show="show"
                :relationList="relationList"
                :modalContent="'RelationShipList'"
            >
            </Modal>
        </portal>
    </div>
</template>
<script>
import PortalVue from "portal-vue";
import Axios from "axios";

Vue.use(PortalVue);
export default {
    props: {
        selectedUser: {},
        loginUser: {},
        isFollowing: "",
        isSelf:{
            default:false,
        },
    },
    data: function () {
        return {
            show: false,
            relationList: [],
            followingUserAmount: this.selectedUser.following_user.length,   
            followedUserAmount: this.selectedUser.followed_user.length   
        };
    },
    methods: {
        followUser: async function () {
            let response = await Axios.post(`/relationship/follow`, {
                selectedUserId: this.selectedUser.id,
                loginUserId: this.loginUser.id,
            });
            this.isFollowing = true;
            this.followedUserAmount += 1;
        },
        unfollowUser: async function () {
            let response = await Axios.post(`/relationship/unfollow`, {
                selectedUserId: this.selectedUser.id,
                loginUserId: this.loginUser.id,
            });
            if (response.data.delete) {
                this.isFollowing = false;
                this.followedUserAmount -= 1;
            }
        },
        showFollows: async function () {
            let response = await Axios.get(
                `/relationship/follow/${this.selectedUser.id}`
            );
            this.relationList = response.data;
            this.show = true;
        },
        showFollowers: async function () {
            let response = await Axios.get(
                `/relationship/follower/${this.selectedUser.id}`
            );
            this.relationList = response.data;
            this.show = true;
        },
    },
};
</script>
