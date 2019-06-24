<template>
    <div class="col-12 row mt-5 justify-content-center bg-light">
        <div class="col-sm-9 m-auto"><canvas id="myChart" width="100%"></canvas></div>

    </div>

</template>

<script>
    import Chart from 'chart.js';

    export default {
        mounted: function () {

            var ctx = document.getElementById('myChart').getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'bar',

                // The data for our dataset
                data: {
                    labels: ['8:00', '9:00', '10:00', '11:00', '12:00', '13:00', '14:00'],
                    datasets: [{
                        label: 'My First dataset',
                        backgroundColor: 'rgb(255, 99, 132)',
                        borderColor: 'rgb(0, 0, 0)',
                        data: [239, 249, 302, 201, 205, 300, 415]
                    }]
                },

                // Configuration options go here
                options: {}
            });
        }
    }
</script>

<style scoped>

</style>
