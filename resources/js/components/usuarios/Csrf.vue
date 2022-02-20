<template>
    <input type="hidden" :name="name" :value="csrf">
</template>

<script>
// component for the csrf-Token

export default {
    props: ['customName'],
    data () {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            defaultName: '_token'
        }
    },
    computed: {
        name() {
            return this.customName ? this.customName : this.defaultName
        }
    }
}
</script>