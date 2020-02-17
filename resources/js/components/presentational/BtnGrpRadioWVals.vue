<template>
    <div class="btn-group float-right" role="group" aria-label="Basic example">
        <button
            v-for="(disp, btnVal) in valAndDisplay"
            type="button"
            :class="getClass(btnVal)"
            @click="handleClick(btnVal)"
            >{{disp}}
        </button>
    </div>
</template>

<script>
    export default {
        props: {'valAndDisplay': Object, 'default' : String,
            val: {
                type: String,
                default: null
            }
        },
        data: function() {
            return {
                defaultClasses : 'btn btn-outline-secondary',
                activeClasses: 'btn btn-secondary'
            };
        },
        methods: {
            getClass: function(btnVal){
                return this.val === btnVal ? this.activeClasses: this.defaultClasses
            },
            handleClick: function(btnVal){
                if(btnVal === this.val){
                    btnVal = this.default;
                }
                //emitting the change will change the value passed in and update the dom
                this.$emit('valChange', btnVal);
            }
        }
    }
</script>
