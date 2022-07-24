<template>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{title}}</strong> {{message}}.
    </div>
</template>

<script>
export default {
    props: ['title', 'message']
}
</script>
