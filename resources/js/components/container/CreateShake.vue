<template>
    <div class="container">
        <div v-if="!showView">
            <input v-model="form.title" placeholder="title.." class="form-control">
            <h5 class="mt-1">Ingredients:</h5>
            <action-list :data="form.ingredients" :btns="listBtns" @deleted="handleIngredientDelete"></action-list>
            <div class="input-group">
                <input v-model="input" placeholder="add ingredient" class="form-control">
                <div class="input-group-prepend">
                    <div class="input-group-text" v-on:click="add">Add</div>
                </div>
            </div>
            <button type="button" class="btn btn-block btn-secondary mt-1" v-show="showSubmit" @click="formSubmit">Submit</button>
        </div>
        <div v-show="showView">
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Congrats!</h4>
                <p>Your shake "{{form.title}}" has been created</p>
                <hr>
                <a :href="'/shake/'+id">Click to view</a>
            </div>
        </div>
    </div>
</template>

<script>
    import ActionList from '../presentational/ActionList'
    function initialState(){
        return {
            form: {
                title: '',
                ingredients: []
            },
            input: '',
            listBtns : ['delete'],
            showSubmit: false,
            showView: false,
            id:null
        }
    }
    export default {
        data() {
            return initialState();
        },
        watch: {
            id: function(){
                this.showView = this.id !== null;
            },
            form: {
                handler(){
                    this.showSubmit = this.validTitle(false) && this.validIngs(false);
                },
                deep: true
            }
        },
        components:{'action-list': ActionList},
        methods: {
            handleIngredientDelete(id){
                let ings = this.form.ingredients;
                for (let key in ings){
                    if(ings.hasOwnProperty(key)){
                        if(ings[key]['id'] === id){
                            this.form.ingredients.splice(key)
                        }
                    }
                }
            },
            genErMsg(){
                this.$notify('An error occurred on save');
            },
            validInput(notify = true){
                if(this.input === ''){
                    if(notify)
                        this.$notify('Ingredients can not be blank');
                    return false;
                }
                return true;
            },
            validIngs(notify = true){
                if(this.form.ingredients.length <= 1){
                    if(notify)
                        this.$notify('Please enter more then one ingredient');
                    return false;
                }
                return true;
            },
            validTitle(){
                if(this.form.title === ''){
                    this.$notify('Title can not be blank');
                    return false;
                }
                return true;
            },
            add: function () {
                if(!this.validInput()) return;
                this.form.ingredients.push({val:this.input, id:this.form.ingredients.length});
                this.input = '';
                this.$notify('Ingredient Added');
            },
            resetWindow: function (){
                Object.assign(this.$data, initialState());
            },
            formSubmit(e) {
                e.preventDefault();
                if(!this.validTitle()) return;
                if(!this.validIngs()) return;
                let _this = this;
                axios.post('/shake', {
                    ...this.form
                })
                .then(function (response) {
                    if(response.data.id){
                        _this.id = response.data.id;
                        _this.$notify('Successfully saved');
                    }
                    else{
                        _this.genErMsg();
                    }
                })
                .catch(function (error) {
                    _this.genErMsg();
                });
            }
        }
    }
</script>
