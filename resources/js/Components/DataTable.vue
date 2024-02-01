<script>
    import { usePage } from '@inertiajs/vue3';

    export default {
        props: {
            serverItems: {
                type: Array,
                required: true,
            },
            columns: {
                type: Array,
                required: true,
            },
            title:{
                type: String,
                required : false
            },
            addNew:{
                type: Boolean,
                required : false
            },
            textBtnAdd:{
                type: String,
                required : false
            },             
            directionNew:{
                type: String,
                required : false
            }, 
        }
    };
  </script>

<template>
    <v-data-table :items="serverItems" :headers="columns">
        <template v-slot:top>
            <v-toolbar
                flat
            >
                <v-toolbar-title>{{ title }}</v-toolbar-title>
                <v-divider
                    class="mx-4"
                    inset
                    vertical
                ></v-divider>
                <v-spacer></v-spacer>
                <template v-if="addNew">
                    <v-btn class="btn btn-primary" :href="directionNew">{{ textBtnAdd }}</v-btn>
                    <!-- <Link :href="''" class="btn btn-primary mx-5">{{ textBtnAdd }}</Link> -->
                </template>

            </v-toolbar>

        </template>
    </v-data-table>
</template>