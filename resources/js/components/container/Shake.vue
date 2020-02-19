<template>
    <div>
        <popover :name="shake.id">
        Created at: {{shake.created_at}} <br>
        Created By: {{created_by}}
        </popover>
        <div class="card box-shadow">
            <div class="card-header">
                {{shake.title}}
                <span class="badge badge-secondary float-right">{{rankingTxt}}</span>
                <span class="float-right mr-2">
                      <button :class="'btn btn-sm btn-outline-'+bootstrap_css_type" v-popover.left="{ name: shake.id }">
                          <i class="fa fa-info"/>
                      </button>
                </span>
            </div>

            <div class="card-body">
                <action-list :bootstrap_css_type="bootstrap_css_type" :data="ingredients"></action-list>
                <a :href="'/shake/' + shake.id">
                    <button type="button" class="btn btn-lg btn-block btn-outline-primary" v-if="displayMode">
                        View <i class="fa fa-eye"></i>
                    </button>
                </a>
                <div class="row mt-2" v-if="!displayMode && authenticated_id > -1">
                    <div class="col-3">
                        <confirm-btn icon="trash" type="danger" v-on:confirm="deleteShake" v-if="showDelete" />
                    </div>
                    <div class="col-6"></div>
                    <div class="col-3">
                        <reaction-btns
                                        class="float-right"
                                        :valAndDisplay="reactionComp.valAndDisplay"
                                       :default="reactionComp.default.toString()"
                                       :val="reactionComp.userReaction"
                                       v-on:valChange="handleReactionChange"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import actionList from '../presentational/ActionList'
    import ReactionBtns from "../presentational/BtnGrpRadioWVals";
    import ConfirmBtn from "../presentational/ConfirmBtn";
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
            if(this.reactions_sum_txt !== null){
                this.rankingTxt = ''+this.reactions_sum_txt;
            }
            else {
                //populate text top right if not passed in
                this.populateReactionSumTxt();
            }

            //get user reaction if this is not display mode
            if(!this.displayMode && this.authenticated_id >-1){
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
        props: {'shake': Object, 'ingredients' : Array,
            'reactions_sum_txt' : {type:Number|null, default:null},
            'displayMode' : Boolean,
            authenticated_id: {type:Number, default:-1},//not needed in display mode
            created_by:String,
            bootstrap_css_type:{type:String, default : 'info'}
        },
        components:{ReactionBtns,ConfirmBtn, 'action-list': actionList},
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
