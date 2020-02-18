<template>
    <button
        type="button"
        :class="btnClass"
        @click="handleClick()">
        <i :class="'fa fa-'+icon"></i>
    </button>
</template>

<script>
    const classStart = 'btn btn-outline-';
    const defaultClassEnd = 'secondary';
    let timeout;
    export default {
        props: {'type': String, 'icon' : String},
        data: function() {
            return {
                btnClass: classStart+defaultClassEnd,
                clicked: false
            };
        },
        methods: {
            handleClick: function(){
                if(this.clicked){
                    this.$emit('confirm');
                    clearTimeout(timeout);
                }
                this.clicked = true;
                this.btnClass = classStart+this.type;
                timeout = setTimeout(()=>{
                    this.reset()
                },5000);//wait 5 seconds before resetting
            },
            reset: function(){
                this.btnClass = classStart + defaultClassEnd;
                this.clicked= false;
            }
        }
    }
</script>
