<template>
    <div class="card box-shadow">
        <div class="card-header">
            {{shake.title}}
            <span class="badge badge-secondary float-right">{{rankingTxt}}</span>
        </div>

        <div class="card-body">
            <action-list :data="ingredients"></action-list>
            <a :href="'/shake/' + shake.id">
                <button type="button" class="btn btn-lg btn-block btn-primary" v-if="displayMode">View</button>
            </a>
            <div class="row mt-2" v-if="!displayMode && authenticated_id">
                <div class="col-3">
                    <button type="button" class="btn btn-danger btn-block" @click="deleteShake" v-if="showDelete">Delete</button>
                </div>
                <div class="col-6"></div>
                <div class="col-3">
                    <reaction-btns :valAndDisplay="reactionComp.valAndDisplay"
                                   :default="reactionComp.default.toString()"
                                   :val="reactionComp.userReaction"
                                   v-on:valChange="handleReactionChange"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import actionList from '../presentational/ActionList'
    import ReactionBtns from "../presentational/BtnGrpRadioWVals";
    export default {
        data: function() {
            return {
                reactionComp: {
                    valAndDisplay : {
                        '-1':'-',
                        '1': '+'
                    },
                    default:0,
                    userReaction:''
                },
                rankingTxt:''
            };
        },
        mounted(){
            //if user does not pass in the sum ranking txt then get it
            //this is so on the main page where 1-> many show, this will not be loaded via ajax,
            //on a single shake page this will be loaded via ajax and then altered inside of this component
            if(this.reactionsSumTxt){
                this.rankingTxt = this.reactionsSumTxt;
            }
            else {
                //populate text top right if not passed in
                this.populateReactionSumTxt();
            }

            //get user reaction if this is not display mode
            if(!this.displayMode){
                let _this = this;
                axios.get('/shake/' + this.shake.id + '/reaction')
                    .then(function (response) {
                        _this.reactionComp.userReaction = response.data.toString();
                    })
                    .catch(function (error) {
                        console.log(error)
                    });
            }
        },
        props: {'shake': Object, 'ingredients' : Array, 'reactionsSumTxt' : String,
            'displayMode' : Boolean, authenticated_id: Number,
        },
        components:{ReactionBtns, 'action-list': actionList},
        methods:{
            populateReactionSumTxt: function(){
                let _this = this;
                axios.get('/shake/' + this.shake.id + '/reaction/sumTxt')
                    .then(function (response) {
                        _this.rankingTxt = response.data;
                    })
                    .catch(function (error) {
                        console.log(error)
                    });
            },
            deleteShake: function () {
                axios.delete('/shake/'+this.shake.id)
                  .then(function (response) {
                    window.location = '/';
                  })
                  .catch(function (error) {
                    console.log(error)
                  })
            },
            handleReactionChange: function (strNewVal) {
                let _this = this;
                let intReaction = parseInt(strNewVal);
                axios.post('/shake/'+this.shake.id+'/reaction/store', {val:intReaction})
                    .then(function (response) {
                        _this.reactionComp.userReaction = strNewVal;
                        _this.populateReactionSumTxt();
                    })
                    .catch(function (error) {
                        console.log(error)
                    })
            }
        },
        computed: {
            // a computed getter
            showDelete: function () {
                return this.authenticated_id === this.shake.user_id;
            }
        }
    }
</script>
