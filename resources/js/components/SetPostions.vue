<template>
    <dir class="row flex-row col-10">
        <ul
            class="modal-content-lineup py-5 col-6 list-unstyled row flex-column"
        >
            <li
                class="py-1 row justify-content-center"
                v-for="(hometeamPlayer, key) in hometeamPlayers"
                :key="key"
            >
                <span class="col-1">{{ hometeamPlayer.number }}</span>
                <span class="col-7">{{ hometeamPlayer.name }}</span>
                <select class="col-2 px-1" v-model="hometeamPlayer.position">
                    <option v-for="(position, key) in positions" :key="key">
                        {{ position }}
                    </option>
                </select>
            </li>
        </ul>
        <ul
            class="modal-content-lineup py-5 col-6 list-unstyled row flex-column"
        >
            <li
                class="py-1 row justify-content-center"
                v-for="(awayteamPlayer, key) in awayteamPlayers"
                :key="key"
            >
                <span class="col-1">{{ awayteamPlayer.number }}</span>
                <span class="col-7">{{ awayteamPlayer.name }}</span>
                <select class="col-2 px-1" v-model="awayteamPlayer.position">
                    <option v-for="(position, key) in positions" :key="key">
                        {{ position }}
                    </option>
                </select>
            </li>
        </ul>
        <button class="btn btn-primaty" @click="contentBtnClick">完了</button>
    </dir>
</template>

<script>
export default {
    props: {
        hometeamPlayers: {},
        awayteamPlayers: {},
        positions: [],
    },
    methods: {
        contentBtnClick: function () {
            this.show = false;
            this.$emit(
                "contentBtnClick",
                [
                    this.hometeamPlayers,
                    this.awayteamPlayers
                ]
            );
        },
    },
}
</script>