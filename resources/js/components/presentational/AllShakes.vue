<template>
    <div class="container">
        <div class="row">
            <shake class="col-sm-4 d-flex mb-3" v-for="shake in shakes" :ingredients="shake.ingredients" :shake="shake" :key="shake.id"
            :reactions_sum_txt="shake.reactions_sum_txt" :displayMode="true"></shake>
        </div>
        <div v-if="!shakes.length">
            <div class="alert alert-secondary" role="alert">
                Sorry, no shakes exist <a href="/shake/create" class="alert-link">click here to create one</a>
            </div>
        </div>
    </div>
</template>

<script>
    import shake from '../container/Shake.vue'
    export default {
        props: {'shakes': Array},
        components: {
            'shake': shake
        }
    }
</script>
