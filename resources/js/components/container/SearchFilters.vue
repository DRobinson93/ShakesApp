<template>
    <div>
        <div v-if="authenticated_id > -1">
            <radioGrp class="btn-block" :valAndDisplay="limitOps" default="" val=""/>
            <hr>
        </div>
        <radioGrp class="btn-block" :valAndDisplay="sortOps" default="" val=""/>
    </div>
</template>

<script>
    import radioGrp from "../presentational/BtnGrpRadioWVals";
    export default {
        props: {
            authenticated_id: {
                type: Number,
                "default": -1
            }
        },
        data: function() {
            return {
                limitOps: {'' : 'All', 'meOnly' : 'Me', 'notMe' : 'Not Me'},
                sortOps: {'' : 'Rating', 'newest' : 'Newest', 'oldest' : 'Oldest'}
            };
        },
        components:{radioGrp},
        methods: {
            handleUserChange(){

            }
        }
    }
</script>
