<template>
    <div
        class="modal-content row flex-row col-7 flex-column justify-content-center py-3"
    >
        <div class="modal-content-teamname row align-items-center">
            <span class="col-6 text-center">{{ hometeamName }}</span>
            <span class="col-6 text-center">{{ awayteamName }}</span>
        </div>
        <div class="row justify-content-center">
            <ul
                class="modal-content-lineup py-3 col-6 list-unstyled row flex-column"
            >
                <li
                    class="py-1 row justify-content-center align-items-center"
                    v-for="(hometeamPlayer, key, index) in hometeamPlayers"
                    :key="key"
                >
                    <span class="col-1 px-0 text-center">{{
                        hometeamPlayer.number
                    }}</span>
                    <span class="col-6">{{ hometeamPlayer.name }}</span>
                    <select
                        class="col-3 custom-select p-0 text-center"
                        v-if="index < 11"
                        v-model="hometeamPlayer.position"
                    >
                        <option selected>Choose...</option>
                        <option v-for="(position, key) in positions" :key="key">
                            {{ position }}
                        </option>
                    </select>
                    <select
                        class="col-3 custom-select p-0 text-center"
                        v-if="index >= 11"
                        v-model="hometeamPlayer.position"
                    >
                        <option selected>RESERVE</option>
                        <option v-for="(position, key) in positions" :key="key">
                            {{ position }}
                        </option>
                    </select>
                </li>
            </ul>
            <ul
                class="modal-content-lineup py-3 col-6 list-unstyled row flex-column"
            >
                <li
                    class="py-1 row justify-content-center align-items-center"
                    v-for="(awayteamPlayer, key, index) in awayteamPlayers"
                    :key="key"
                >
                    <span class="col-1 px-0 text-center">{{
                        awayteamPlayer.number
                    }}</span>
                    <span class="col-6">{{ awayteamPlayer.name }}</span>
                    <select
                        class="col-3 custom-select p-0 text-center"
                        v-if="index < 11"
                        v-model="awayteamPlayer.position"
                    >
                        <option selected>Choose...</option>
                        <option v-for="(position, key) in positions" :key="key">
                            {{ position }}
                        </option>
                    </select>
                    <select
                        class="col-3 custom-select p-0 text-center"
                        v-if="index >= 11"
                        v-model="awayteamPlayer.position"
                    >
                        <option selected>RESERVE</option>
                        <option v-for="(position, key) in positions" :key="key">
                            {{ position }}
                        </option>
                    </select>
                </li>
            </ul>
        </div>
        <button
            class="btn btn-primary col-2 offset-10"
            @click="contentBtnClick"
        >
            完了
        </button>
    </div>
</template>

<script>
import axios from "axios";
export default {
    props: {},
    data: function () {
        return {
            hometeamPlayers: {},
            awayteamPlayers: {},
            hometeamName: "",
            awayteamName: "",
            positions: [
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
                "RESERVE",
            ],
        };
    },
    mounted: async function () {
        let fixtureIdParam = location.search;
        let response = await axios.get(`/api/players${fixtureIdParam}`);
        console.log(response.data);
        this.hometeamPlayers = response.data.players.hometeamPlayers;
        this.awayteamPlayers = response.data.players.awayteamPlayers;
        this.hometeamName = response.data.hometeamName;
        this.awayteamName = response.data.awayteamName;
    },
    methods: {
        contentBtnClick: function () {
            this.show = false;
            this.$emit("contentBtnClick", [
                this.hometeamPlayers,
                this.awayteamPlayers,
            ]);
        },
    },
};
</script>
