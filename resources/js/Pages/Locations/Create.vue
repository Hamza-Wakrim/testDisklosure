<script setup>
    // Importing the MainLayout component and useForm from Inertia.js
    import MainLayout from '../../Layouts/MainLayout.vue';
    import { useForm } from '@inertiajs/vue3';

    // Creating a form instance using Inertia.js useForm
    const form = useForm({
        latitude: null,
        longitude: null,
        timezone: '',
        timezone_abbreviation: '',
        utc_offset_seconds: null,
    })
</script>

<template>
    <!-- Using the MainLayout component as the layout for this page -->
    <MainLayout>
        <!-- Displaying the page header -->
        <div class="row">
            <div class="col-sm-6"><h1>Create New Location</h1></div>
        </div>

        <!-- Location creation form -->
        <form @submit.prevent="form.post('/locations')" class="p-3">
            <div class="mb-3">
                <label for="latitude" class="form-label">Latitude</label>
                <input id="latitude" v-model="form.latitude" type="number" step="0.000001" class="form-control">
                <div v-if="form.errors.latitude" class="text-red-600 text-sm">{{ form.errors.latitude }}</div>
            </div>

            <div class="mb-3">
                <label for="longitude" class="form-label">Longitude</label>
                <input id="longitude" v-model="form.longitude" type="number" step="0.000001" min="-180" max="180" class="form-control">
                <div v-if="form.errors.longitude" class="text-red-600 text-sm">{{ form.errors.longitude }}</div>
            </div>

            <div class="mb-3">
                <label for="timezone" class="form-label">Timezone</label>
                <input id="timezone" v-model="form.timezone" type="text" maxlength="50" class="form-control">
                <div v-if="form.errors.timezone" class="text-red-600 text-sm">{{ form.errors.timezone }}</div>
            </div>

            <div class="mb-3">
                <label for="timezone_abbreviation" class="form-label">Timezone Abbreviation</label>
                <input id="timezone_abbreviation" v-model="form.timezone_abbreviation" type="text" maxlength="10" class="form-control">
                <div v-if="form.errors.timezone_abbreviation" class="text-red-600 text-sm">{{ form.errors.timezone_abbreviation }}</div>
            </div>

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
