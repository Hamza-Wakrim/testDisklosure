<script setup>
    import MainLayout from '../../Layouts/MainLayout.vue';

    const props = defineProps({
        weatherData : Object
    });
    const weatherData = props.weatherData;

</script>

<template>
    <MainLayout>
        <div class="row">
            <div class="col-sm-6"><h1>Weather Data Details</h1> </div>
        </div>
        <div class="mb-3">
            <label for="id" class="form-label">Id : {{ weatherData.id }}</label>
        </div>
        <div class="mb-3">
            <label for="latitude" class="form-label">Location Id : {{ weatherData.location_id }}</label>
        </div>

        <div class="mb-3">
            <label for="timezone" class="form-label">Generationtime ms : {{weatherData.generationtime_ms}}</label>
        </div>

        <div class="mb-3">
            <label for="longitude" class="form-label">Elevation : {{ weatherData.elevation }}</label>
        </div>

        <div class="mb-3">
            <label for="timezone" class="form-label">Time : {{weatherData.hourly_units.time}}</label>
        </div>

        <div class="mb-3">
            <label for="timezone" class="form-label">Temperature : {{weatherData.hourly_units.temperature_2m}}</label>
        </div>

        <div class="mb-3">
            <label for="timezone_abbreviation" class="form-label">created at : {{weatherData.created_at}}</label>
        </div>

        <div class="mb-3">
            <label for="utc_offset_seconds" class="form-label">updated at : {{weatherData.updated_at}}</label>
        </div>

    </MainLayout>
</template>
