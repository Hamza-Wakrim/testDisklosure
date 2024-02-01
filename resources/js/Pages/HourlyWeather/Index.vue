<script setup>
    // Importing necessary dependencies and components
    import { Link } from '@inertiajs/vue3';
    import { reactive, ref } from 'vue';

    import MainLayout from '../../Layouts/mainLayout.vue';
    import DataTable from '../../Components/DataTable.vue';

    // Defining props to receive data from the parent component
    const props = defineProps({
        hourlyWeather: Array,
    });

    const header =  [
        {
          title: '#',
          align: 'start',
          sortable: false,
          key: 'id',
        },
        { title: 'Time', key: 'time', align: 'end' },
        { title: 'Type', key: 'type', align: 'end' },
        { title: 'Value', key: 'value', align: 'end' },
        { title: 'Actions', key: 'actions', align: 'end' }
    ]

    const Locations = "Hourly Weather Data"
    const textBtnNew = "Add Hourly Weather"

    const directionAdd = '/hourly-weather/create'

</script>

<template>
    <!-- Using the MainLayout component as the layout for this page -->
    <MainLayout>
        <!-- Displaying the page header and a button to create new hourly weather data -->
        <!-- <div class="row">
            <div class="col-sm-6"><h1>Hourly Weather Data</h1></div>
            <div class="col-sm-6"><Link :href="'/hourly-weather/create'" class="btn btn-success">New Hourly Weather Data</Link></div>
        </div> -->
        <!-- Displaying a table with a list of hourly weather data items -->
        <DataTable :serverItems="props.hourlyWeather" :columns="header" :title="Locations" :addNew="true" :textBtnAdd="textBtnNew" :directionNew="directionAdd"/>


    
    </MainLayout>
</template>
