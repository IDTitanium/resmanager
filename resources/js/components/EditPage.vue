<template>
    <div>
        <admin-ui :showAlert="showAlert" :alertMessage="alertMessage" :alertTitle="alertTitle">
            <div class="mb-3 mt-5">
                <label for="title" class="form-label">Title</label>
                <input v-model="title" type="text" class="form-control" id="title" placeholder="Enter link title" required>
            </div>
            <div class="mb-3 mt-5">
                <label for="title" class="form-label">Description</label>
                <textarea v-model="description" class="form-control" id="textarea1" rows="3" required></textarea>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
            <button type="submit" :disabled="btnClicked" @click="submit" class="btn btn-md btn-primary">{{ submitMessage }}</button>
            </div>
        </admin-ui>
    </div>
</template>

<script>
import AdminUI from './AdminUI.vue'
export default {
    components: { AdminUI },
    props: ['resource'],
    data() {
        return {
            title: '',
            description: '',
            showAlert: false,
            alertMessage: '',
            alertTitle: '',
            submitMessage: 'Submit',
            btnClicked: false
        }
    },
    created() {
        if(this.resource) {
            this.title = this.resource.title
            this.description = this.resource.description
        }
    },
    methods: {
        submit() {
            this.submitMessage = 'Submitting'
            this.btnClicked = true
            this.showAlertWithTimer()

            const formData = {
                title: this.title,
                description: this.description
            }

            axios.patch(`/admin/resource/edit/${this.resource.id}`, formData).then(res => {
                console.log(res)
                this.btnClicked = false
                this.submitMessage = 'Submit'
                this.showAlertWithTimer()
                this.alertMessage = 'Resource saved successfully'
                this.alertTitle = 'Success!'
            }).catch(e => {
                console.error(e)
                this.btnClicked = false
                this.submitMessage = 'Submit'
                this.showAlertWithTimer()
                this.alertMessage = 'Resource could not be saved'
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
</script>
