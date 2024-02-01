<script setup>
    import MainLayout from '../../Layouts/MainLayout.vue';

    const props = defineProps({
        location : Object
    });
    const location = props.location;

</script>

<template>
    <MainLayout>
        <div class="row">
            <div class="col-sm-6"><h1>Location Details</h1> </div>
        </div>
        <div class="mb-3">
            <label for="id" class="form-label">Id : {{ location.id }}</label>
        </div>
        <div class="mb-3">
            <label for="latitude" class="form-label">Latitude : {{ location.latitude }}</label>
        </div>

        <div class="mb-3">
            <label for="longitude" class="form-label">Longitude : {{ location.longitude }}</label>
        </div>

        <div class="mb-3">
            <label for="timezone" class="form-label">Timezone : {{location.timezone}}</label>
        </div>

        <div class="mb-3">
            <label for="timezone_abbreviation" class="form-label">Timezone Abbreviation : {{location.timezone_abbreviation}}</label>
        </div>

        <div class="mb-3">
            <label for="utc_offset_seconds" class="form-label">UTC Offset Seconds : {{location.utc_offset_seconds}}</label>
        </div>

    </MainLayout>
</template>
