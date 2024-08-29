@extends('layouts.app')
@section('content')
<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="title pb-20">
            <h2 class="h3 mb-0">Overview</h2>
        </div>

        <div class="row pb-10">
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <a href="{{ route('admin.program.index') }}">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark">{!! App\Models\Program::count(); !!}</div>
                                <div class="font-14 text-secondary weight-500">
                                    Total Program
                                </div>
                            </div>
                            <div class="widget-icon">
                                <div class="icon" data-color="#00eccf">
                                    <i class="fas fa-book"></i> <!-- Font Awesome icon for Program -->
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <a href="{{ route('admin.subject.index') }}">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark">{!! App\Models\Subject::count(); !!}</div>
                                <div class="font-14 text-secondary weight-500">
                                    Total Subject
                                </div>
                            </div>
                            <div class="widget-icon">
                                <div class="icon" data-color="#ff5b5b">
                                    <i class="fas fa-book-reader"></i> <!-- Font Awesome icon for Subject -->
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <a href="#">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark">1</div>
                                <div class="font-14 text-secondary weight-500">
                                    Total Faculty
                                </div>
                            </div>
                            <div class="widget-icon">
                                <div class="icon" data-color="#ff5b5b">
                                    <i class="fas fa-chalkboard-teacher"></i> <!-- Font Awesome icon for Faculty -->
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <a href="#">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark">1</div>
                                <div class="font-14 text-secondary weight-500">
                                    Total Student
                                </div>
                            </div>
                            <div class="widget-icon">
                                <div class="icon" data-color="#09cc06">
                                    <i class="fas fa-user-graduate"></i> <!-- Font Awesome icon for Student -->
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
{{-- @section('scripts')
<script src="{!! asset('src/plugins/apexcharts/apexcharts.min.js') !!}"></script>
<script src="{!! asset('js/dashboard.js') !!}"></script>

<script type="text/javascript">
var data = JSON.parse('{!! $data !!}');
    var options5 = {
	chart: {
		height: 350,
		type: 'bar',
		parentHeightOffset: 0,
		fontFamily: 'Poppins, sans-serif',
		toolbar: {
			show: false,
		},
	},
	colors: ['#1b00ff', '#f56767', '#008000'],
	grid: {
		borderColor: '#c7d2dd',
		strokeDashArray: 5,
	},
	plotOptions: {
		bar: {
			horizontal: false,
			columnWidth: '25%',
			endingShape: 'rounded'
		},
	},
	dataLabels: {
		enabled: false
	},
	stroke: {
		show: true,
		width: 2,
		colors: ['transparent']
	},
    series: [{"name":"Inquiries","data": data['0']['inquiry']},{"name":"Feedback","data": data['0']['feedback']}],
	xaxis: {
		categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
		labels: {
			style: {
				colors: ['#353535'],
				fontSize: '16px',
			},
		},
		axisBorder: {
			color: '#8fa6bc',
		}
	},
	yaxis: {
		title: {
			text: 'Inquiries'
		},
		labels: {
			style: {
				colors: '#353535',
				fontSize: '16px',
			},
		},
		axisBorder: {
			color: '#f00',
		}
	},
	legend: {
		horizontalAlign: 'right',
		position: 'top',
		fontSize: '16px',
		offsetY: 0,
		labels: {
			colors: '#353535',
		},
		markers: {
			width: 10,
			height: 10,
			radius: 15,
		},
		itemMargin: {
			vertical: 0
		},
	},
	fill: {
		opacity: 1

	},
	tooltip: {
		style: {
			fontSize: '15px',
			fontFamily: 'Poppins, sans-serif',
		},
		y: {
			formatter: function (val) {
				return val
			}
		}
	}
};

var chart5 = new ApexCharts(document.querySelector("#chart5"), options5);
chart5.render();
</script>
@endsection --}}
