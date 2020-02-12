<template>
    <ul class="list-group">
        <li v-for="d in data" class="list-group-item">
            {{ d.val }}
            <div class="float-right">
                <button class="btn btn-secondary btn-sm" v-if="btns.includes('delete')" @click="handleDel(d.id)">Delete</button>
            </div>
        </li>
    </ul>
</template>

<script>
    export default {
        props: {
            data: {
                type: Array
            },
            btns: {
                type: Array,
                default: function(){return []}
            }
        },
        methods: {
            handleDel: function(id){
                if(this.canDelete()){
                    this.$emit('deleted', id)
                }
            },
            canDelete: function(){
                if(this.data.length > 2){
                    return true;
                }
                this.$notify('A shake must contain more then one ingredient','danger');
                return false;
            }
        }
    }
</script>
