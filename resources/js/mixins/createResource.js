export default {
    methods: {
        submitCreateRequest(type, data, options = {}) {
            this.submitMessage = 'Submitting'
            this.btnClicked = true

            this.$store.dispatch('createResource', data, options).then(res => {
                this.btnClicked = false
                this.submitMessage = 'Submit'
                this.showAlertWithTimer()
                this.alertMessage = `${type} saved successfully`
                this.alertTitle = 'Success!'
            }).catch(e => {
                console.error(e)
                this.btnClicked = false
                this.submitMessage = 'Submit'
                this.showAlertWithTimer()
                this.alertMessage = `${type} could not be saved`
                this.alertTitle = 'Error!'
            })
        },
        showAlertWithTimer() {
            this.showAlert = true
            setTimeout(() => {
                this.showAlert = false
            }, 4000);
        }
    }
}
