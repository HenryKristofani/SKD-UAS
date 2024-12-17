<template>
    <WeatherComponent></WeatherComponent>
    <RekomendasiComponent></RekomendasiComponent>
</template>

<script>
import WeatherComponent from './Cuaca/WeatherComponent.vue';
import RekomendasiComponent from './Cuaca/RekomendasiComponent.vue';

export default {
    components: {
        WeatherComponent,
        RekomendasiComponent
    }
};
</script>