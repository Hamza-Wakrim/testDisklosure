<script setup>
    // Importing MainLayout component, useForm function, and other dependencies
    import MainLayout from '../../Layouts/MainLayout.vue';
    import { useForm } from '@inertiajs/vue3';

    // Defining props to receive data from the parent component
    const props = defineProps({
        weatherdata: Array,
    });

    // Extracting the weatherdata array from props
    const weatherdata = props.weatherdata;

    // Creating a form using useForm
    const form = useForm({
        weatherdata_id: null,
        time: '',
        type: '',
        value: null,
    });
</script>

<template>
    <!-- Using the MainLayout component as the layout for this page -->
    <MainLayout>
        <!-- Creating a form for submitting new Hourly Weather Data -->
        <div class="row">
            <div class="col-sm-6"><h1>Create New Hourly Weather Data</h1></div>
        </div>
        <form @submit.prevent="form.post('/hourly-weather')" class="p-3">

            <!-- Dropdown for selecting Weather Data ID -->
            <div class="mb-3">
                <label for="weatherdata_id" class="form-label">Weather Data ID</label>
                <select id="weatherdata_id" v-model="form.weatherdata_id" class="form-select">
                    <!-- Iterating over weatherdata array to populate dropdown options -->
                    <option selected>Weather Data ID</option>
                    <option v-for="data in weatherdata" :key="data.id" :value="data.id">
                        <!-- Displaying information about each weather data item in the dropdown option -->
                        <pre>
                            location Id: {{ data.location.id }} | generationtime_ms: {{ data.generationtime_ms }} | elevation: {{ data.elevation }}
                            <div v-for="(hourly_unit, key) in data.hourly_units">| {{ key }}: {{ hourly_unit }}</div>
                        </pre>
                    </option>
                </select>
                <!-- Displaying error message if there is an error with weatherdata_id -->
                <div v-if="form.errors.weatherdata_id" class="text-red-600 text-sm">{{ form.errors.weatherdata_id }}</div>
            </div>

            <!-- Input field for Time -->
            <div class="mb-3">
                <label for="time" class="form-label">Time</label>
                <input v-model="form.time" type="datetime-local" id="time" class="form-control">
                <!-- Displaying error message if there is an error with time -->
                <div v-if="form.errors.time" class="text-red-600 text-sm">{{ form.errors.time }}</div>
            </div>

            <!-- Input field for Type -->
            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <input v-model="form.type" type="text" id="type" class="form-control">
                <!-- Displaying error message if there is an error with type -->
                <div v-if="form.errors.type" class="text-red-600 text-sm">{{ form.errors.type }}</div>
            </div>

            <!-- Input field for Value -->
            <div class="mb-3">
                <label for="value" class="form-label">Value</label>
                <input v-model="form.value" type="number" step="0.1" id="value" class="form-control">
                <!-- Displaying error message if there is an error with value -->
                <div v-if="form.errors.value" class="text-red-600 text-sm">{{ form.errors.value }}</div>
            </div>

            <!-- Submit button for form submission -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </MainLayout>
</template>
