<template>
    <div class="container">

        <alert :message="alertMessage" :title="alertTitle" v-if="showAlert"></alert>
        <div class="row justify-content-center mt-5">

            <div class="col-md-8">
                <a class="mb-5 btn btn-sm btn-success" href="/">Go to Home page</a>
                <div class="card">
                    <div class="card-header">
                        <a href="/admin">
                          Admin Page
                        </a>
                    </div>

                    <div class="card-body">
                        <slot></slot>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Alert from './Alert.vue'
    export default {
        components: { Alert },
        mounted() {
            console.log('Admin UI mounted.')
        },
        props: ['alertMessage', 'alertTitle', 'showAlert'],
    }
</script>
