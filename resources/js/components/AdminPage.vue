<template>
    <div>
        <admin-ui>
            Welcome to the admin page {{name}}.

            <div class="list-group mt-5">
                <a href="/admin/resource/pdf" type="button" class="btn list-group-item list-group-item-action list-group-item-success" aria-current="true">
                    Upload a PDF
                </a>
                <a href="/admin/resource/snippet" type="button" class="btn list-group-item list-group-item-action list-group-item-primary">Upload an HTML snippet</a>
                <a href="/admin/resource/link" type="button" class="btn list-group-item list-group-item-action list-group-item-success">Create a new link</a>
            </div>
        </admin-ui>
    </div>
</template>

<script>
import AdminUI from './AdminUI.vue'
    export default {
        components: { AdminUI },
        mounted() {
            console.log('Component mounted.')
        },
        props: ['name']
    }
</script>
