<template>
    <div class="tactical-board row flex-column align-items-center">
        <field
            ref="field"
            :init-hometeam-players="initHometeamPlayers"
            :init-awayteam-players="initAwayteamPlayers"
        ></field>
        <tactical-board-buttons
            @captureBoard="captureBoard"
        ></tactical-board-buttons>
    </div>
</template>
<script>
export default {
    props: {
        initHometeamPlayers: {},
        initAwayteamPlayers: {},
    },
    methods: {
        captureBoard: function () {
            console.log("app発火");
            this.$refs.field.capture();
        },
    },
};
</script>
