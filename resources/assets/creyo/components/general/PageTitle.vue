<template>
    <div class="account-title">
        <h2>{{title}}</h2>
        <img class="brand-filigrane" src="/images/logo/nephos-greyscale.svg" alt="">
    </div>
</template>
<script>
    export default {
        name: 'page-title',
        props: {
            title: {
                required: true
            }
        },
    };
</script>