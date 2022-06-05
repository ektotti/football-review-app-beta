<template>
    <div class="col-10">
        <div class="card">
            <div class="card-header">{{ listTitle }}</div>
            <ul class="list-group list-group-flush">
                <li
                    class="list-group-item"
                    v-for="(fixture, index) in fixtures.data"
                    :key="index"
                >
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
                <li class="list-group-item">
                    <div  class="card-link row justify-content-center">
                        <a class="col-4 offset-2" :href="fixtures.prev_page_url">PREV</a>
                        <a class="col-3 offset-3" :href="fixtures.next_page_url">NEXT</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
import Axios from 'axios';
export default {
    props: {
        fixtures: [],
        listTitle: "",
        isPost:'',
    },
    mounted: function () {
        $response = Axios.get('/fixture/recent');
    },
};
</script>
