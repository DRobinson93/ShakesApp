<template>
    <ul class="list-group">
        <li v-for="(d, index) in data" :class="getLiClass(index)">
            {{ d.val }}
            <div class="float-right">
                <button class="btn btn-warning btn-sm" v-if="btns.includes('delete')" @click="handleDel(d.id)">
                    <i class="fa fa-minus"></i>
                </button>
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
            },
            bootstrap_css_type: {
                type: String,
                default: 'info'
            }
        },
        methods: {
            getLiClass: function(index){
                //every other give color
                return 'list-group-item ' + (index%2===1?'list-group-item-'+this.bootstrap_css_type:'');
            },
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
