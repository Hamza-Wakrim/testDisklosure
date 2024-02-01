<script setup>
    // Importing the Link and router components from the Inertia.js Vue 3 package
    import { Link, router } from "@inertiajs/vue3";

    // Defining props to receive data from the parent component
    const props = defineProps({
        weatherdata: Object,
    });

    // Extracting the weatherdata from props
    const weatherdata = props.weatherdata;

    // Defining emits to emit custom events
    const emit = defineEmits(['deleteEvent']);

    // Function to delete weather data
    const deleteDataItem = (id) => {
        // Confirming deletion with a confirmation dialog
        if (confirm("Are you sure?")) {
            // Using the router to send a delete request to the specified URL
            router.delete(`/weather-data/${id}`);
        }

        // Emitting a custom delete event
        emit('deleteEvent', id);
    };
</script>

<template>
    <!-- Displaying a table row for the weather data -->
    <tr>
        <!-- Displaying the weather data properties in table cells -->
        <th scope="row">{{weatherdata.id}}</th>
        <td>{{weatherdata.location_id}}</td>
        <td>{{weatherdata.generationtime_ms}}</td>
        <td>{{weatherdata.elevation}}</td>
        <td>{{weatherdata.hourly_units.time}}</td>
        <td>{{weatherdata.hourly_units.temperature_2m}}</td>
        <td>
            <!-- Action buttons with Inertia.js Link and button elements -->
            <ul class="list-inline m-0">
                <li class="list-inline-item">
                    <!-- View Detail button with Inertia.js Link -->
                    <Link class="btn btn-primary" :href="`/weather-data/${weatherdata.id}`">Detail</Link>
                </li>
                <li class="list-inline-item">
                    <!-- Edit button with Inertia.js Link -->
                    <Link class="btn btn-warning" :href="`/weather-data/${weatherdata.id}/edit`">Edit</Link>
                </li>
                <li class="list-inline-item">
                    <!-- Delete button with a click event -->
                    <button class="btn btn-danger" @click="deleteDataItem(weatherdata.id)">Delete</button>
                </li>
            </ul>
        </td>
    </tr>
</template>
