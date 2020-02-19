<template>
    <div>
        <div v-if="authenticated_id > -1">
            <radioGrp class="btn-block" :valAndDisplay="limitOps" default="" :val="limitVal" 
                v-on:valChange="handleLimitValChange"/>
            <hr>
        </div>
        <radioGrp class="btn-block" :valAndDisplay="sortOps" default="" :val="sort_val"
            v-on:valChange="handleSortValChange"/>
    </div>
</template>

<script>
    import radioGrp from "../presentational/BtnGrpRadioWVals";
    export default {
        props: {
            authenticated_id: {
                type: Number,
                "default": -1
            }, sort_val:String
        },
        data: function() {
            return {
                limitOps: {'' : 'All', 'meOnly' : 'Me', 'notMe' : 'Not Me'},
                sortOps: {'' : 'Rating', 'newest' : 'Newest', 'oldest' : 'Oldest'}, 
                limitVal:''
            };
        },
        components:{radioGrp},
        methods: {
            handleSortValChange(val){
                location.href = location.href + "?sort=" + val;
            }, 
            handleLimitValChange(val){
                this.limitVal = val;
            }
        }
    }
</script>
