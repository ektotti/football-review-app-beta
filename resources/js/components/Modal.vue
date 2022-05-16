<template>
    <div class="modal-base row justify-content-center" v-show="show">
        <div class="modal-overlay text-center"></div>
        <div class="modal-content row flex-row col-10">
            <component
                :is="modalContent"
            ></component>
            <SetPostions
                @contentBtnClick="contentBtnClick"
                :hometeamPlayers="hometeamPlayers"
                :awayteamPlayers="awayteamPlayers"
                >
            </SetPostions>
        </div>
    </div>
</template>

<script>
import SetPostions from './SetPostions.vue';
export default {
  components: { SetPostions },
    props: {
        hometeamPlayers: {},
        awayteamPlayers: {},
        positions: [],
        modalContent: '',
    },
    data: function () {
        return {
            show: true,
        };
    },
    methods: {
        contentBtnClick: function (...args) {
            this.show = false;
            console.log(args);
            this.$emit(
                "contentBtnclick",
                args,
            );
        },
    },
};
</script>
