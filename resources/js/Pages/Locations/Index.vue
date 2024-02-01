<script setup>
    // Importing necessary components and libraries
    import { Link } from '@inertiajs/vue3';
    import { reactive, ref } from 'vue';
    import MainLayout from '../../Layouts/MainLayout.vue';
    // import LocationCard from '../../Components/LocationCard.vue';
    import DataTable from '../../Components/DataTable.vue';


    // Extracting locations array from props
    const props = defineProps({
        locations: Array,
    });

    // Creating a reactive state to manage locations
    const state = reactive({
        locations: props.locations,
    });

    // const header = [
    //     {text: '#', value: 'id'},
    //     {text: 'Latitude', value: 'latitude'},
    //     {text: 'Longitude', value: 'longitude'},
    //     {text: 'Timezone', value: 'timezone'},
    //     // {text: 'Actions', value: 'action'},
    // ]
    const header =  [
        {
          title: '#',
          align: 'start',
          sortable: false,
          key: 'id',
        },
        { title: 'Latitude', key: 'latitude', align: 'end' },
        { title: 'Longitude', key: 'longitude', align: 'end' },
        { title: 'Timezone', key: 'timezone', align: 'end' },
        { title: 'Actions', key: 'actions', align: 'end' }
    ]

    const Locations = "Locations"
    const textBtnNew = "Add Location"

    const directionAdd = '/locations/create'
    // Function to delete a location item
    // const deleteLocationItem = (id) => {
    //     state.locations = ref([...state.locations.filter(item => item.id !== id)]);
    // }
</script>

<template>
    <!-- Using the MainLayout component as the layout for this page -->
    <MainLayout>
        <!-- Displaying the page header and a button to create a new location -->
        <!-- <div class="row">
            <div class="col-sm-6"><h1>Locations</h1></div>
            <div class="col-sm-6"><Link :href="'/locations/create'" class="btn btn-success" >New Location</Link></div>
        </div> -->

        <DataTable :serverItems="props.locations" :columns="header" :title="Locations" :addNew="true" :textBtnAdd="textBtnNew" :directionNew="directionAdd"/>

        
    </MainLayout>
</template>
