<template>
    <div class="card box-shadow">
        <div class="card-header">
            {{shake.title}}
            <span class="badge badge-secondary float-right">{{ratingSumTxt}}</span>
        </div>

        <div class="card-body">
            <action-list :data="shake.ingredients"></action-list>
            <a :href="'/shake/' + shake.id">
                <button type="button" class="btn btn-lg btn-block btn-primary" v-if="displayMode">View</button>
            </a>
            <div class="row mt-2" v-if="!displayMode && authenticated">
                <div class="col-3">
                    <button type="button" class="btn btn-danger btn-block" @click="deleteShake">Delete</button>
                </div>
                <div class="col-6"></div>
                <div class="col-3">
                    <button type="button" class="btn btn-danger btn-block">-1</button>
                    <button type="button" class="btn btn-success btn-block">+1</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import actionList from '../presentational/ActionList'
    export default {
        props: {'shake': Object, 'ratingSumTxt' : String, 'displayMode' : Boolean, authenticated: Boolean},
        components:{'action-list': actionList}, 
        methods:{
            deleteShake: function () {
                axios.delete('/shake/'+this.shake.id)
                  .then(function (response) {
                    window.location = '/';
                  })
                  .catch(function (error) {
                    console.log(error)
                  })
            }
        }
    }
</script>
