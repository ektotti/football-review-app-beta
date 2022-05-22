<template>
<div class="col-10">
    <div class="card mb-1" v-for="(fixture, index) in fixtures" :key="index">
        <div class="card-body">
            <a
                class="row justify-content-center"
                :href="'/create/board/'+fixture.id"
            >
                <span class="col-4 text-center">{{ fixture.hometeam_name }}</span>
                <span class="col-3 text-center">VS</span>
                <span class="col-4 text-center">{{ fixture.awayteam_name }}</span>
            </a>
        </div>
    </div>
</div>
</template>
<script>
export default {
    props: {
        fixtures:[],
    },
};
</script>
