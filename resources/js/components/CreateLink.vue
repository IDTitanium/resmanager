<template>
    <div>
        <admin-ui :showAlert="showAlert" :alertMessage="alertMessage" :alertTitle="alertTitle">
            <span class="mb-5">
                <strong>
                    Create a Html Resource
                </strong>
            </span>

            <div class="mb-3 mt-5">
                <label for="title" class="form-label">Title</label>
                <input v-model="title" type="text" class="form-control" id="title" placeholder="Enter link title" required>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Link</label>
                <input v-model="link" type="text" class="form-control" id="link" placeholder="Enter link url" required>
            </div>
            <div class="form-check">
            <input v-model="value_tab" class="form-check-input" value="" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
            <label class="form-check-label" for="flexRadioDefault1">
                Open in current tab
            </label>
            </div>
            <div class="form-check">
            <input v-model="value_tab" class="form-check-input" value="blank" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
            <label class="form-check-label" for="flexRadioDefault2">
                Open in new tab
            </label>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
            <button type="submit" :disabled="btnClicked" @click="submit" class="btn btn-md btn-primary">{{ submitMessage }}</button>
            </div>
        </admin-ui>
    </div>
</template>

<script>
import constants from '../constants'
import createResource from '../mixins/createResource'
import AdminUI from './AdminUI.vue'
export default {
    components: { AdminUI },
    mixins: [createResource],
    mounted() {
        console.log('Create link is mounted')
    },
    data() {
        return {
            showAlert: false,
            alertMessage: '',
            alertTitle: '',
            title: '',
            link: '',
            btnClicked: false,
            submitMessage: 'Submit',
            value_tab: ''
        }
    },
    methods: {
        submit() {
            const formData = {
                title: this.title,
                value: this.link,
                value_tab: this.value_tab,
                type: constants.link
            }

            this.submitCreateRequest(constants.link, formData)
        },
    }
}
</script>
