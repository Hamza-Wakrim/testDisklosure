
<script setup>
    import { Link } from '@inertiajs/vue3';
    import Navbar from './navbar.vue';

</script>

<template>
    <div class="container">
        <Navbar/>
        <slot>

        </slot>
    </div>
</template>
