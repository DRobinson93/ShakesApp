<template>
    <div class="container">
        <div class="row">
            <shake class="col-4 mb-3" v-for="(shake, index) in shakes" :ingredients="shake.ingredients"
                   :created_by="shake.user.name" :shake="shake" :key="shake.id"
                    :reactions_sum_txt="shake.reactions_sum_txt" :displayMode="true"
                    :bootstrap_css_type="getColor(index)"/>
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
    const shakeBootstrapCssTypes= [
      'info'
    ];
    const numOfTypes = shakeBootstrapCssTypes.length;
    export default {
        props: {'shakes': Array},
        components: {
            'shake': shake
        },
        methods: {
            getColor: function(index){
                if(shakeBootstrapCssTypes[index] !== undefined) {
                    return shakeBootstrapCssTypes[index];
                }
                //else index > amount of types, find relative index in const shakeBootstrapCssTypes
                let remainder = index % numOfTypes;
                return shakeBootstrapCssTypes[remainder];
            }
        }
    }
</script>
