<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
// import { TextModes } from '@vue/compiler-core';
</script>
<script>
    export default {
        data() {
            return {
                temperatures: {},
                cities: {},
            }
        },
        mounted() {
            // call user login temperatures on component mounted
            this.getTemperatures();
        },
        methods: {
            // get user login temperatures
            getTemperatures () {
                axios.get('/gettemperatures').then((response)=>{

                    this.temperatures = response.data;

                    for (let key in this.temperatures) {
                        this.cities[key] = key;
                    }

                });
            },
            // list temperatures in hottest to coldest order
            hottest(event) {

                for (let city in this.cities) {
                    let cityArray = this.temperatures[city];
                    cityArray.sort(function(a, b) {
                        return (b.celsius - a.celsius || b.fahrenheit - a.fahrenheit);
                    });
                }

            },
            // list temperatures in default order
            reset(event) {

                for (let city in this.cities) {
                    let cityArray = this.temperatures[city];
                    cityArray.sort(function(a, b) {
                        return (a.id - b.id);
                    });
                }

            }
        }
        
    }
</script>
<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>

        <div class="py-12">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
                <span class="block text-gray-700 text-left font-black bg-blue-200 px-4 py-2">Login Temperatures</span>
            </div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="py-4 pr-4 flex bg-gray-200 gap-4 justify-end">
                    <button @click="hottest" class="bg-red-500 hover:bg-red-500 text-white font-bold py-2 px-4 rounded">
                        Hottest First
                    </button>
                    <button @click="reset" class="bg-gray-500 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded">
                        Reset Order
                    </button>
                </div>
            </div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 gap-4">

                    <div v-for="(temperature, city) in temperatures" v-if="temperatures" class="max-w-auto rounded overflow-hidden shadow-lg">
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2">{{city}}</div>
                            <ul class="list-none sm:list-disc md:list-decimal lg:list-disc xl:list-none divide-y">

                                <li v-for="(login, index) in temperature" class="pt-3 flex justify-between">
                                    <span class="flex-1 text-left">{{login.record_date}}</span>
                                    <span class="flex-1 text-right">{{login.celsius}}°C</span>
                                    <span class="flex-1 text-right">{{login.fahrenheit}}°F</span>
                                </li>

                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </BreezeAuthenticatedLayout>
</template>
