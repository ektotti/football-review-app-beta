<template>
    <div id="field" class="tactical-board-field justify-content-center">
        <HometeamPlayers
            v-for="(
                hometeamPlayersInPosition, key
            ) in hometeamPlayersInPositions"
            :key="'home' + key"
            :class-name="hometeamPlayersInPosition.position"
            :number="hometeamPlayersInPosition.number"
            :name="hometeamPlayersInPosition.name | formatPlayerName"
        >
        </HometeamPlayers>
        <AwayteamPlayers
            v-for="(
                awayteamPlayersInPosition, key
            ) in awayteamPlayersInPositions"
            :key="'away' + key"
            :class-name="awayteamPlayersInPosition.position"
            :number="awayteamPlayersInPosition.number"
            :name="awayteamPlayersInPosition.name | formatPlayerName"
        >
        </AwayteamPlayers>
        <Canvas ref="canvas"></Canvas>
        <portal to="modal">
            <Modal
                @contentBtnClick="setPlayers"
                :showModal="showModal"
                :modalContent="'SetPostions'"
            >
            </Modal>
        </portal>
    </div>
</template>

<script>
import Canvas from "./Canvas.vue";
import HometeamPlayers from "./HometeamPlayers.vue";
import AwayteamPlayers from "./AwayteamPlayers.vue";
import Modal from "./Modal.vue";
import PortalVue from "portal-vue";
import html2canvas from "html2canvas";

Vue.use(PortalVue);
export default {
    props: ["selectedMatch"],
    data: function () {
        return {
            hometeamPlayersInPositions: {},
            awayteamPlayersInPositions: {},
            showModal: true,
        };
    },
    computed: {
        hometeamPlayers: function () {
            let newArray = {};
            for (let key in this.initHometeamPlayers) {
                newArray[key] = {
                    name: this.initHometeamPlayers[key].name,
                    number: this.initHometeamPlayers[key].number,
                    position: "",
                };
            }
            return newArray;
        },
        awayteamPlayers: function () {
            let newArray = {};
            for (let key in this.initAwayteamPlayers) {
                newArray[key] = {
                    name: this.initAwayteamPlayers[key].name,
                    number: this.initAwayteamPlayers[key].number,
                    position: "",
                };
            }
            return newArray;
        },
    },
    methods: {
        capture: async function () {
            let canvas = await html2canvas(this.$el, {
                scale: 2,
            });
            let canvasData = await canvas.toDataURL('image/jpeg');
            for (let i = 1; i <= 4; i++) {
                if (!sessionStorage.getItem(`image${i}`)) {
                    sessionStorage.setItem(`image${i}`, canvasData);
                    break;
                }
            }
            alert("一時保存しました。");
        },
        setPlayers: function (...args) {
            this.hometeamPlayersInPositions = args[0][0];
            this.awayteamPlayersInPositions = args[0][1];
            this.showModal = false;
        },
    },
    components: {
        HometeamPlayers,
        AwayteamPlayers,
        Modal,
        Canvas,
    },
};
</script>
