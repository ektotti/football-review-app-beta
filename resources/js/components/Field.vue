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
        <portal to="modal">
            <Modal
                @contentBtnClick="setPlayers"
                :hometeamPlayers="hometeamPlayers"
                :awayteamPlayers="awayteamPlayers"
                :positions="positions"
            >
            </Modal>
        </portal>
    </div>
</template>

<script>
import HometeamPlayers from "./HometeamPlayers.vue";
import AwayteamPlayers from "./AwayteamPlayers.vue";
import Modal from "./Modal.vue";
import PortalVue from "portal-vue";
import html2canvas from "html2canvas";

Vue.use(PortalVue);
export default {
    props: {
        initHometeamPlayers: {},
        initAwayteamPlayers: {},
    },
    data: function () {
        return {
            hometeamPlayersInPositions: {},
            awayteamPlayersInPositions: {},
            positions: [
                "",
                "GK",
                "CB",
                "RCB",
                "LCB",
                "RSB",
                "LSB",
                "ANK",
                "RCH",
                "LCH",
                "RWB",
                "LWB",
                "RSH",
                "LSH",
                "RIH",
                "LIH",
                "OMF",
                "RWG",
                "LWG",
                "RST",
                "LST",
                "CF",
            ],
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
                scale :4
            });
            let canvasData = await canvas.toDataURL();
            for(let i = 1; i <= 4; i++){
                if(!sessionStorage.getItem(`image${i}`)){
                    sessionStorage.setItem(`image${i}`, canvasData);
                    break
                }
            }
            alert('一時保存しました。');
            // let response = await axios.post("/capture", {
            //     data: canvasData,
            // });
        },
        setPlayers: function (
            hometeamPlayersSetPositions,
            awayteamPlayersSetPositions
        ) {
            this.hometeamPlayersInPositions = hometeamPlayersSetPositions;
            this.awayteamPlayersInPositions = awayteamPlayersSetPositions;
        },
    },
    components: {
        HometeamPlayers,
        AwayteamPlayers,
        Modal,
    },
};
</script>
