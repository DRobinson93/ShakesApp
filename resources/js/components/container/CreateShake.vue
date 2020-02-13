<template>
    <div>
        <input v-model="form.title" placeholder="title.." class="form-control">
        <h5 class="mt-1">Ingredients:</h5>
        <action-list :data="form.ingredients" :btns="listBtns" @deleted="handleIngredientDelete"></action-list>
        <div class="input-group">
            <input v-model="input" placeholder="add ingredient" class="form-control">
            <div class="input-group-prepend">
                <div class="input-group-text" v-on:click="add">Add</div>
            </div>
        </div>
        <button type="button" class="btn btn-block btn-secondary mt-1" @click="formSubmit">Submit</button>
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
            listBtns : ['delete']
        }
    }
    export default {
        data() {
            return initialState();
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
            validInput(){
                if(this.input === ''){
                    this.$notify('Ingredients can not be blank');
                    return false;
                }
                return true;
            },
            validIngs(){
                if(this.form.ingredients.length <= 1){
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
                this.$notify.success('Ingredient Added');
            },
            resetWindow: function (){
                Object.assign(this.$data, initialState());
            },
            formSubmit(e) {
                e.preventDefault();
                if(!this.validTitle()) return;
                if(!this.validIngs()) return;
                let _this = this;
                axios.post('shake/create', {
                    ...this.form
                })
                .then(function (response) {
                    if(response.data.success){
                        _this.$notify.success('Successfully saved');
                        _this.resetWindow();
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