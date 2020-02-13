<template>
    <div class="card box-shadow">
        <div class="card-header">
            {{this.shake.title}}
            <span class="badge badge-secondary float-right">{{this.ratingSumTxt}}</span>
        </div>

        <div class="card-body">
            <action-list :data="this.shake.ingredients"></action-list>
            <a :href="'/shake/' + this.shake.id">
                <button type="button" class="btn btn-lg btn-block btn-primary" v-if="this.displayMode">View</button>
            </a>
            <div class="row mt-2" v-if="!this.displayMode">
                <div class="col-3">
                    <button type="button" class="btn btn-danger btn-block">-1</button>
                </div>
                <div class="col-6"></div>
                <div class="col-3">
                    <button type="button" class="btn btn-success btn-block">+1</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import actionList from '../presentational/ActionList'
    export default {
        props: {'shake': Object, 'ratingSumTxt' : String, 'displayMode' : Boolean},
        components:{'action-list': actionList}
    }
</script>
