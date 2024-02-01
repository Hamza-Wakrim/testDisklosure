<script setup>
    import {Link} from '@inertiajs/vue3';

</script>

<template>
    <nav class="navbar navbar-expand-lg navbar-light mb-5">
        <!-- <Link class="navbar-brand" :href="'/locations'">Home</Link> -->

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item active">
                <Link class="nav-link" :href="'/locations'">Locations</Link>
            </li>
            <li class="nav-item">
                <Link class="nav-link" :href="'/weather-data'">Weather Data</Link>
            </li>
            <li class="nav-item">
                <Link class="nav-link" :href="'/hourly-weather'">Hourly Weather</Link>
            </li>
            </ul>
        </div>
    </nav>
</template>
