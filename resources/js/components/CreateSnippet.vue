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
                <input v-model="title" type="text" class="form-control" id="title" placeholder="Enter snippet title" required>
            </div>
            <div class="mb-3 mt-5">
                <label for="title" class="form-label">Description</label>
                <textarea v-model="description" class="form-control" id="textarea1" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="textarea1" class="form-label">Snippet</label>
                <textarea v-model="snippet" class="form-control" id="textarea1" rows="3" required></textarea>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
            <button type="submit" :disabled="btnClicked" @click="submit" class="btn btn-md btn-primary">{{ submitMessage }}</button>
            </div>
        </admin-ui>
    </div>
</template>

<script>
import AdminUI from './AdminUI.vue'
import createResource from '../mixins/createResource.js'
import constants from '../constants.js'

export default {
    components: { AdminUI },
    mixins: [createResource],
    mounted() {
        console.log('Create snippet is mounted')
    },
    data() {
        return {
            showAlert: false,
            alertMessage: '',
            alertTitle: '',
            title: '',
            snippet: '',
            btnClicked: false,
            submitMessage: 'Submit',
            description: ''
        }
    },
    methods: {
        submit() {

            const formData = new FormData()
            formData.append('snippet', this.snippet)
            formData.append('title', this.title)
            formData.append('description', this.description)
            formData.append('type', constants.snippet)

            const options = {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            }

            this.submitCreateRequest(constants.snippet, formData, options)
        },
    }
}
</script>
