<template>
    <div class="col-10">
        <div class="card">
            <div class="card-header">{{listTitle}}</div>
            <ul
                class="list-group list-group-flush"
                v-for="(fixture, index) in fixtures"
                :key="index"
            >
                <li class="list-group-item">
                    <a
                        class="card-link row justify-content-center"
                        :href="'/create/board/' + fixture.id"
                    >
                        <span class="card-text col-4 text-center">{{
                            fixture.hometeam_name
                        }}</span>
                        <span class="card-text col-3 text-center">VS</span>
                        <span class="card-text col-4 text-center">{{
                            fixture.awayteam_name
                        }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        fixtures: [],
        listTitle: "",
    },
};
</script>
