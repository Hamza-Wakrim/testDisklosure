<script setup>
    // Importing necessary components and libraries
    import { Link } from '@inertiajs/vue3';
    import MainLayout from '../../Layouts/MainLayout.vue';
    import { reactive, ref } from 'vue';
    import WeatherDataCard from '../../Components/WeatherDataCard.vue';
    import DataTable from '../../Components/DataTable.vue';

    // Extracting data from props
    const props = defineProps({
        weatherData: Array,
    });

    const header =  [
        {
          title: '#',
          align: 'start',
          sortable: false,
          key: 'id',
        },
        { title: 'Location Id', key: 'location_id', align: 'end' },
        { title: 'Generationtime ms', key: 'generationtime_ms', align: 'end' },
        { title: 'Elevation', key: 'elevation', align: 'end' },
        { title: 'Time Unit', key: 'hourly_units.time', align: 'end' },
        { title: 'Temperature Unit', key: 'hourly_units.temperature_2m', align: 'end' }
    ]

    const Locations = "Weather Data"
    const textBtnNew = "Add Weather"

    const directionAdd = '/weather-data/create'
</script>

<template>
    <!-- Using the MainLayout component as the layout for this page -->
    <MainLayout>
        <!-- Displaying the page header with buttons for creating new weather data -->
        <!-- <div class="row">
            <div class="col-sm-6">
                <h1>Weather Data</h1>
            </div>
            <div class="col-sm-6">
                <Link :href="'/weather-data/create'" class="btn btn-success">New Weather Data</Link>
            </div>
        </div> -->

        
        <DataTable :serverItems="props.weatherData" :columns="header" :title="Locations" :addNew="true" :textBtnAdd="textBtnNew" :directionNew="directionAdd"/>
    </MainLayout>
</template>
