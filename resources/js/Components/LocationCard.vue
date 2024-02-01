<script setup>
    // Importing the Link and router components from the Inertia.js Vue 3 package
    import { Link, router } from "@inertiajs/vue3";

    // Defining props to receive data from the parent component
    const props = defineProps({
        location: Object,
    });

    // Extracting the location from props
    const location = props.location;

    // Defining emits to emit custom events
    const emit = defineEmits(['deleteEvent']);

    // Function to delete a location item
    const deleteLocationItem = (id) => {
        // Confirming deletion with a confirmation dialog
        if (confirm("Are you sure?")) {
            // Using the router to send a delete request to the specified URL
            router.delete(`/locations/${id}`);
        }

        // Emitting a custom delete event
        emit('deleteEvent', id);
    };
</script>

<template>
    <!-- Displaying a table row for the location data -->
    <tr>
        <!-- Displaying the location properties in table cells -->
        <th scope="row">{{location.id}}</th>
        <td>{{location.latitude}}</td>
        <td>{{location.longitude}}</td>
        <td>{{location.timezone}}</td>
        <td>
            <!-- Action buttons with Inertia.js Link and button elements -->
            <ul class="list-inline m-0">
                <li class="list-inline-item">
                    <!-- Show Hourly Data In A Chart -->
                    <Link class="btn btn-info" :href="`/charts/${location.id}`">Hourly Data Chart</Link>
                </li>
                <li class="list-inline-item">
                    <!-- View Detail button with Inertia.js Link -->
                    <Link class="btn btn-primary" :href="`/locations/${location.id}`">Detail</Link>
                </li>
                <li class="list-inline-item">
                    <!-- Edit button with Inertia.js Link -->
                    <Link class="btn btn-warning" :href="`/locations/${location.id}/edit`">Edit</Link>
                </li>
                <li class="list-inline-item">
                    <!-- Delete button with a click event -->
                    <button class="btn btn-danger" @click="deleteLocationItem(location.id)">Delete</button>
                </li>
            </ul>
        </td>
    </tr>
</template>
