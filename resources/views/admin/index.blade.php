<x-admin-master>
    @section('content')
    @if (auth()->user()->UserHasRole('Admin'))
        <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
        @endif 
        <div>
            <canvas id="myChart"></canvas>
        </div>
    @endsection
    
    @section('table scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('myChart');
            let labels = ['Users','Post','Users Media' ,'All Media', 'Roles','Category'
            /* ,'Permission' */];
            let datasets = [];
        
            @if (auth()->user()->UserHasRole('Admin'))
                let data = [{{$UserCount}},{{$PostCount}}, 0, {{$MediaCount}},{{$RoleCount}},{{$CategoryCount}}
               
            ]; // Added 0 for 'All Media'
                let backgroundColors = ['rgba(255, 99, 132, 0.4)',//pink, 
                                    'rgba(54, 162, 235, 0.2)',//blue 
                                    
                                    'rgba(153, 102, 255, 0.2)',//green
                                    'rgba(102, 255,102, 0.5)',//green 
                                    'rgba(255, 102,102, 0.8)',//green 
                                    'rgba(102,0,51, 0.5)',//blue 
                                    'rgba(255,128, 0, 0.5)',// orange 
                                 
                                    ];
        
                datasets.push
                ({
                    label: 'Admin Data',
                    data: data,
                    backgroundColor: backgroundColors,
                    borderColor: 'rgba(0, 0, 0, 1)',
                // borderColor: borderColors,
                    borderWidth:1,
                
                });
            
                @foreach($users as $user)
                    @if (!$user->UserHasRole('Admin'))
                    datasets.push
                    ({
                    label: 'Media - {{$user->name}}',
                        data: [0, 0, {{$user->uploadphotos_count }}], // Added 0 for 'Users' and 'Posts'
                        backgroundColor: 'rgba(0, 0, 0, 0.2)',
                        borderColor: 'rgba(0, 0, 0, 1)',
                        borderWidth: 1,
                        stack: 'All Media',
                    });
                    @endif
                @endforeach
            
            @else
                labels = ['Posts', 'Media', 'Comments', 'Replies'];
                let data = [{{$PostCount}}, {{$MediaCount}}, {{$CommentCount}}, {{$replyCount}}];
                let backgroundColors = [
                    'rgba(54, 162, 235, 0.2)', // Blue
                    'rgba(255, 206, 86, 0.2)', // Yellow
                    'rgba(75, 192, 192, 0.2)', // Green
                    'rgba(153, 102, 255, 0.2)' // Purple
                ];
                let borderColors = [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)'
                ];

                datasets.push({
                    label: 'User Data',
                    data: data,
                    backgroundColor: backgroundColors,
                    borderColor: borderColors,
                    borderWidth: 1
                            });
            @endif

                new Chart(ctx, 
                {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: datasets   
                    },
                    options: {
                    plugins: {
                    legend: {
                        labels: {
                            filter: function(item, chart) {
                                // This checks to see if the label is not 'Admin Data' or does not start with 'Media - ' it return false and items not show
                            // return !(item.text === 'Admin Data' || item.text.startsWith('Media - ')); 
                                return !(  item.text.startsWith('Media - '));
                            }
                        },
                        annotation: {
                            annotations: {
                                centerLine: {
                                    type: 'line',
                                    yMin: 50, // Replace with the value you want to highlight
                                    yMax: 50, // Replace with the value you want to highlight
                                    borderColor: 'rgb(255, 99, 132)',
                                    borderWidth: 2
                                }
                            }
                        }
                        //display: false
                    },
                /*   tooltip: {
                        enabled: false
                    } */
                   },
                   responsive: true,
                   scales: 
                   {   
                        x: {
                            beginAtZero: true,
                        },
                        y: {
                            beginAtZero: true,   
                        }
                    }
                }    
            });
        </script>  
    @endsection   
</x-admin-master>
    
