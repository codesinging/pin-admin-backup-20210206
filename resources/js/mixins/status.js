module.exports = {
    data() {
        return {
            statuses: admin.statuses,
        }
    },
    methods: {
        $true(key) {
            this.$set(this.statuses, key, true)
        },
        $false(key) {
            this.$set(this.statuses, key, false)
        },
    }
}