<div class="card-body">
    <strong class="mt-2">Sales and Visits Over Time</strong>
    <div id="chart-sales-visit" style="height: 350px;"></div>
    <p>
        Sales Track Record:
        <strong id="salesTrackValue"
                style="font-weight: bold; padding: 5px 10px; border: 1px solid #ccc; border-radius: 4px; background-color: #f9f9f9; display: inline-block;">
            {{$salesTrackRecord ?? 0}}%
        </strong>
    </p>
    <p>
        Location Accuration:
        <strong id="salesTrackValue"
                style="font-weight: bold; padding: 5px 10px; border: 1px solid #ccc; border-radius: 4px; background-color: #f9f9f9; display: inline-block;">
            0%
        </strong>
    </p>
</div>
@push('script')
    <script>
        var salesTrackValue = {{$salesTrackRecord ?? 0}};

        var salesTrackElement = document.getElementById('salesTrackValue');

        function setTrackRecordColor(value) {
            if (value >= 0 && value <= 25) {
                salesTrackElement.style.color = 'red';
            } else if (value > 25 && value <= 50) {
                salesTrackElement.style.color = 'yellow';
            } else if (value > 50 && value <= 75) {
                salesTrackElement.style.color = 'orange';
            } else if (value > 75 && value < 100) {
                salesTrackElement.style.color = 'green';
            } else if (value == 100) {
                salesTrackElement.style.color = 'blue';
            }
        }

        @if($salesTrackRecord)
        setTrackRecordColor(salesTrackValue);
        @endif

        document.addEventListener("DOMContentLoaded", function () {
            let dataVisited = [];
            let dataVisitedButNotSchedule = [];
            let categories = [];

            let mappedDataVisited = {};
            let mappedDataScheduledNotVisited = {};

            @if($salesMappingStatisticVisited)
                @foreach($salesMappingStatisticVisited as $visited)
                mappedDataVisited['{{ $visited->visit_date }}'] = {{ $visited->total }};
            @endforeach
                @endif

                @if($salesMappingStatisticScheduledNotVisited)

                @foreach($salesMappingStatisticScheduledNotVisited as $scheduledNotVisited)
                mappedDataScheduledNotVisited['{{ $scheduledNotVisited->visit_date }}'] = {{ $scheduledNotVisited->total }};
            @endforeach
            @endif

            // Combine the keys (visit_date) from both mapped data and sort them
            categories = [...new Set([
                ...Object.keys(mappedDataVisited),
                ...Object.keys(mappedDataScheduledNotVisited)
            ])].sort();

            // Populate series data based on sorted categories
            dataVisited = categories.map(category => mappedDataVisited[category] || 0);
            dataVisitedButNotSchedule = categories.map(category => mappedDataScheduledNotVisited[category] || 0);

            console.log(categories)

            var options = {
                chart: {
                    type: 'area',
                    height: 350, // Atur tinggi chart
                    width: '100%' // Atur lebar chart agar responsif
                },
                series: [
                    {
                        name: 'Scheduled but not visited',
                        data: dataVisitedButNotSchedule,
                        color: '#6C757D'  // Dark gray for scheduled
                    },
                    {
                        name: 'Visits',
                        data: dataVisited,
                        color: '#007BFF'  // Blue for visited
                    }
                ],
                xaxis: {
                    categories: categories,
                    type: 'category',
                    tickPlacement: 'on',
                },
                stroke: {
                    curve: 'smooth'
                },
                // title: {
                //     text: '',
                //     align: 'top'
                // },
                tooltip: {
                    x: {
                        format: 'dd/MM/yyyy'
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart-sales-visit"), options);
            chart.render();
        });
    </script>
@endpush
