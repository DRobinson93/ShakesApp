<template>
    <div class="container">
        <div class="card-columns">
            <shake v-for="shake in shakes" :shake="shake" :key="shake.id" ratingSumTxt="+1" :displayMode="true"></shake>
        </div>
    </div>
</template>

<script>
    import shake from '../container/Shake.vue'
    export default {
        props: {'shakes': Object},
        components: {
            'shake': shake
        }
    }
</script>
