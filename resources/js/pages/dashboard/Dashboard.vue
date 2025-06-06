<script setup lang="ts">
import DashboardLayout from '@/layouts/DashboardLayout.vue'
import { ScrollArea } from '@/components/design'
import { ref } from 'vue'
import { getCssVar } from 'quasar'

defineOptions({
    name: 'Dashboard'
})

////////////////////////////////////////////////////////////////
const options = ref({
    chart: {
        id: 'vuechart-example'
    },
    xaxis: {
        categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998]
    }
})

const series = ref([{
    name: 'series-1',
    data: [30, 40, 45, 50, 49, 60, 70, 91]
}])

///////////////////////////////////////////////////////////////
const options_line = ref({
    title: {
        text: 'ApexLine',
        align: 'left'
    },
    chart: {
        id: 'apex-line'
    },
    // colors: [getCssVar('primary'), getCssVar('secondary'), getCssVar('negative')],
    colors: [getCssVar('primary'), getCssVar('secondary'), getCssVar('negative')],
    markers: {
        size: 4,
        hover: {
            sizeOffset: 6
        }
    },
    xaxis: {
        categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998]
    }
})

const series_line = ref([{
    name: 'series-1',
    data: [30, 40, 45, 50, 49, 60, 70, 91]
}])

///////////////////////////////////////////////////////////////

const series_pie = [44, 55, 13, 43, 22]
const chartOptions_pie = {
    chart: {
        width: 380,
        type: 'pie',
    },
    labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
    responsive: [{
        breakpoint: 480,
        options: {
            chart: {
                width: 200
            },
            legend: {
                position: 'bottom'
            }
        }
    }]
}
</script>

<template>
<DashboardLayout>
    <scroll-area style="height: calc(100vh - 120px)">
        <q-list>
            <q-item>
                <q-item-section>
                    <apexchart width="500" type="bar" :options="options" :series="series"></apexchart>
                </q-item-section>
                <q-item-section>
                    <apexchart height="300" width="500" type="line" :options="options_line" :series="series_line">
                    </apexchart>
                </q-item-section>
                <q-item-section>
                    <apexchart type="pie" width="380" :options="chartOptions_pie" :series="series_pie"></apexchart>
                </q-item-section>
            </q-item>
        </q-list>

        {{ $page }} <br /> <br />
        {{ $page.props.ziggy }} <br /> <br />
        ------------------------------------- <br /> <br />
        {{ $page.url }} <br /> <br />
        {{ $page.props.ziggy.location }} <br /> <br />
        ------------------------------------- <br /> <br />
        {{ $page.props.ziggy.as }} <br /> <br />

    </scroll-area>
</DashboardLayout>
</template>
