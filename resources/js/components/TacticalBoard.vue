<template>
    <div class="tactical-board row flex-column align-items-center">
        <field
            ref="field"
            :init-hometeam-players="initHometeamPlayers"
            :init-awayteam-players="initAwayteamPlayers"
        ></field>
        <tactical-board-buttons
            @captureBoard="captureBoard"
            :isPost="isPost"
        ></tactical-board-buttons>
    </div>
</template>
<script>
export default {
    props:[
        "initHometeamPlayers",
        "initAwayteamPlayers",
        "isPost",
        "selectedFixture"
    ],
    methods: {
        captureBoard: function () {
            this.$refs.field.capture();
        },
    },
};
</script>
