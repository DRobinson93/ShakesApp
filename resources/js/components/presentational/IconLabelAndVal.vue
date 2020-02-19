<template>
    <span>
        <i :class="'fa fa-'+icon"/> <span  class="font-weight-bold">{{label}}:</span> {{val}}
    </span>
</template>

<script>
    export default {
        props: {
            icon: String,
            val:String,
            label:String
        }
    }
</script>
