<script setup>
    // Importing the Link and router components from the Inertia.js Vue 3 package
    import { Link, router } from '@inertiajs/vue3';

    // Defining props to receive data from the parent component
    const props = defineProps({
        hourlyItem: Object,
    });

    // Extracting the hourlyItem from props
    const hourlyItem = props.hourlyItem;

    // Defining emits to emit custom events
    const emit = defineEmits(['deleteEvent']);

    // Function to delete a hourlyItem
    const deleteHourlyItem = (id) => {
        // Confirming deletion with a confirmation dialog
        if (confirm("Are you sure?")) {
            // Using the router to send a delete request to the specified URL
            router.delete(`/hourly-weather/${id}`);
        }

        // Emitting a custom delete event
        emit('deleteEvent', id);
    };
</script>

<template>
    <!-- Displaying a table row for the hourlyItem data -->
    <tr>
        <!-- Displaying the hourlyItem properties in table cells -->
        <th scope="row">{{hourlyItem.id}}</th>
        <td>{{hourlyItem.time}}</td>
        <td>{{hourlyItem.type}}</td>
        <td>{{hourlyItem.value}}</td>
        <td>
            <!-- Action buttons with Inertia.js Link and button elements -->
            <ul class="list-inline m-0">
                <li class="list-inline-item">
                    <!-- View Detail button with Inertia.js Link -->
                    <Link class="btn btn-primary" :href="`/hourly-weather/${hourlyItem.id}`">Detail</Link>
                </li>
                <li class="list-inline-item">
                    <!-- Edit button with Inertia.js Link -->
                    <Link class="btn btn-warning" :href="`/hourly-weather/${hourlyItem.id}/edit`">Edit</Link>
                </li>
                <li class="list-inline-item">
                    <!-- Delete button with a click event -->
                    <button class="btn btn-danger" @click="deleteHourlyItem(hourlyItem.id)">Delete</button>
                </li>
            </ul>
        </td>
    </tr>
</template>
