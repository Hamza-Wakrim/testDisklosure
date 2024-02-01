<script setup>
    // Importing the MainLayout component
    import MainLayout from '../../Layouts/MainLayout.vue';

    // Defining props to receive data from the parent component
    const props = defineProps({
        hourlyWeather: Object,
    });

    // Extracting the hourlyWeather object from props
    const hourlyWeather = props.hourlyWeather;
</script>

<template>
    <!-- Using the MainLayout component as the layout for this page -->
    <MainLayout>
        <!-- Displaying the page header -->
        <div class="row">
            <div class="col-sm-6"><h1>Hourly Weather Data Details</h1></div>
        </div>

        <!-- Displaying details of the hourly weather data -->
        <div class="mb-3">
            <label for="id" class="form-label">Id: {{ hourlyWeather.id }}</label>
        </div>
        <div class="mb-3">
            <label for="latitude" class="form-label">Time: {{ hourlyWeather.time }}</label>
        </div>

        <div class="mb-3">
            <label for="longitude" class="form-label">Type: {{ hourlyWeather.type }}</label>
        </div>

        <div class="mb-3">
            <label for="timezone" class="form-label">Value: {{hourlyWeather.value}}</label>
        </div>

        <div class="mb-3">
            <label for="timezone_abbreviation" class="form-label">Created at: {{hourlyWeather.created_at}}</label>
        </div>

        <div class="mb-3">
            <label for="utc_offset_seconds" class="form-label">Updated at: {{hourlyWeather.updated_at}}</label>
        </div>
    </MainLayout>
</template>
