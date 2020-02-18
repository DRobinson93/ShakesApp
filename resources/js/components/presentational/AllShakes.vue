<template>
    <div class="container">
        <div class="card-columns">
            <shake v-for="shake in shakes" :ingredients="shake.ingredients" :shake="shake" :key="shake.id"
            :reactionsSumTxt="shake.reactionsSumTxt" :displayMode="true"></shake>
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
