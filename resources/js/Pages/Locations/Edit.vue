<script setup>
    // Importing the MainLayout component and useForm from Inertia.js
    import MainLayout from '../../Layouts/MainLayout.vue';
    import { useForm } from '@inertiajs/vue3';

    // Extracting location object from props
    const props = defineProps({
        location: Object
    });
    const location = props.location;

    // Creating a form instance using Inertia.js useForm and initializing with location data
    const form = useForm({
        latitude: location.latitude,
        longitude: location.longitude,
        timezone: location.timezone,
        timezone_abbreviation: location.timezone_abbreviation,
        utc_offset_seconds: location.utc_offset_seconds,
    });
</script>

<template>
    <!-- Using the MainLayout component as the layout for this page -->
    <MainLayout>
        <!-- Displaying the page header -->
        <div class="row">
            <div class="col-sm-6"><h1>Edit Location</h1></div>
        </div>

        <!-- Displaying location details (read-only) -->
        <div class="mb-3">
            <label for="id" class="form-label">Id</label>
            <input id="id" v-model="location.id" type="number" step="0.000001" min="-90" max="90" class="form-control" disabled>
        </div>

        <!-- Location editing form -->
        <form @submit.prevent="form.put(`/locations/${location.id}`)" class="p-3">
            <!-- Latitude input -->
            <div class="mb-3">
                <label for="latitude" class="form-label">Latitude</label>
                <input id="latitude" v-model="form.latitude" type="number" step="0.000001" min="-90" max="90" class="form-control">
                <div v-if="form.errors.latitude" class="text-red-600 text-sm">{{ form.errors.latitude }}</div>
            </div>

            <!-- Longitude input -->
            <div class="mb-3">
                <label for="longitude" class="form-label">Longitude</label>
                <input id="longitude" v-model="form.longitude" type="number" step="0.000001" min="-180" max="180" class="form-control">
                <div v-if="form.errors.longitude" class="text-red-600 text-sm">{{ form.errors.longitude }}</div>
            </div>

            <!-- Timezone input -->
            <div class="mb-3">
                <label for="timezone" class="form-label">Timezone</label>
                <input id="timezone" v-model="form.timezone" type="text" maxlength="50" class="form-control">
                <div v-if="form.errors.timezone" class="text-red-600 text-sm">{{ form.errors.timezone }}</div>
            </div>

            <!-- Timezone Abbreviation input -->
            <div class="mb-3">
                <label for="timezone_abbreviation" class="form-label">Timezone Abbreviation</label>
                <input id="timezone_abbreviation" v-model="form.timezone_abbreviation" type="text" maxlength="10" class="form-control">
                <div v-if="form.errors.timezone_abbreviation" class="text-red-600 text-sm">{{ form.errors.timezone_abbreviation }}</div>
            </div>

            <!-- UTC Offset Seconds input -->
            <div class="mb-3">
                <label for="utc_offset_seconds" class="form-label">UTC Offset Seconds</label>
                <input id="utc_offset_seconds" v-model="form.utc_offset_seconds" type="number" class="form-control">
                <div v-if="form.errors.utc_offset_seconds" class="text-red-600 text-sm">{{ form.errors.utc_offset_seconds }}</div>
            </div>

            <!-- Submit button for the form -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </MainLayout>
</template>
