<template>
    <div>
        <admin-ui :showAlert="showAlert" :alertMessage="alertMessage" :alertTitle="alertTitle">
            <span class="mb-5">
                <strong>
                    Create a pdf resource
                </strong>
            </span>

            <div class="mb-3 mt-5">
                <label for="title" class="form-label">Title</label>
                <input v-model="title" type="text" class="form-control" id="title" placeholder="Enter pdf title" required>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Upload PDF file</label>
                <input v-on:change="getFile" ref="formFile" accept=".pdf" class="form-control" type="file" id="formFile" required>
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
            console.log('Create pdf mounted.')
        },
        data() {
            return {
                title: '',
                file: null,
                btnClicked: false,
                submitMessage: 'Submit',
                showAlert: false,
                alertMessage: '',
                alertTitle: ''
            }
        },
        props: ['name'],
        methods: {
            submit() {
                const formData = new FormData()

                formData.append('file', this.file)
                formData.append('title', this.title)
                formData.append('type', constants.document)

                const options = {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                }

                this.submitCreateRequest(constants.document, formData, options)
            },
            getFile(data) {
                this.file = data.target.files[0]
                console.log(this.file)
            }
        }
    }
</script>
