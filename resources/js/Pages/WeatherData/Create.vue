<script setup>
    // Importing necessary components and libraries
    import MainLayout from '../../Layouts/MainLayout.vue';
    import { useForm } from '@inertiajs/vue3'

    // Creating a reactive form using the useForm function
    const form = useForm({
        location_id: null,
        generationtime_ms: null,
        elevation: '',
        time_unit: 'iso8601',
        temperature_2m: "temperature_2m",
        hourly_units: null,
    })

    // Extracting locations array from props
    const props = defineProps({
        locations: Array,
    });

    // Extracting locations array from props
    const locations = props.locations;
</script>

<template>
    <!-- Using the MainLayout component as the layout for this page -->
    <MainLayout>
        <!-- Displaying the page header -->
        <div class="row">
            <div class="col-sm-6">
                <h1>Create New Weather Data</h1>
            </div>
        </div>

        <!-- Weather data creation form -->
        <form @submit.prevent="form.post('/weather-data')" class="p-3">
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <!-- Dropdown for selecting a location -->
                <select id="location" v-model="form.location_id" class="form-select" aria-label="Default select example">
                    <option disabled selected value="">Open this to select location</option>
                    <!-- Iterating through locations to populate dropdown options -->
                    <option v-for="location in locations" :key="location.id" :value="location.id">
                        {{ location.latitude }} ({{ location.longitude }})
                    </option>
                </select>
                <div v-if="form.errors.location_id" class="text-red-600 text-sm">{{ form.errors.location_id }}</div>
            </div>

            <!-- Other form fields for weather data attributes -->
            <div class="mb-3">
                <!-- Generationtime in ms -->
                <label for="generationtime_ms" class="form-label">Generationtime in ms</label>
                <input id="generationtime_ms" v-model="form.generationtime_ms" type="number" step="0.001" min="0" class="form-control">
                <div v-if="form.errors.generationtime_ms" class="text-red-600 text-sm">{{ form.errors.generationtime_ms }}</div>
            </div>

            <div class="mb-3">
                <!-- Elevation -->
                <label for="elevation" class="form-label">Elevation</label>
                <input id="elevation" v-model="form.elevation" type="number" step="0.1" min="0" class="form-control">
                <div v-if="form.errors.elevation" class="text-red-600 text-sm">{{ form.errors.elevation }}</div>
            </div>

            <!-- Time unit -->
            <div class="mb-3">
                <label for="time_unit" class="form-label">Time</label>
                <input id="time_unit" v-model="form.time_unit" type="text" value="iso8601" maxlength="10" class="form-control">
                <div v-if="form.errors.time_unit" class="text-red-600 text-sm">{{ form.errors.time_unit }}</div>
            </div>

            <!-- Temperature unit -->
            <div class="mb-3">
                <label for="temperature_2m" class="form-label">temperature_2m</label>
                <input id="temperature_2m" v-model="form.temperature_2m" type="text" value="°C" maxlength="10" class="form-control">
                <div v-if="form.errors.temperature_2m" class="text-red-600 text-sm">{{ form.errors.temperature_2m }}</div>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </MainLayout>
</template>
