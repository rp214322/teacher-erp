@extends('admin.layouts.app')
@section('title','City')
@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <!-- Simple Datatable start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix mb-20">
                        <div class="pull-left">
                            <h4 class="text-blue h4">List City</h4>
                        </div>
                        <div class="pull-right">
                            <a href="javascript:;" class="fill_data btn btn-primary" data-url="{!! route('admin.city.create') !!}" data-method="get">
                                Add New City
                            </a>
                        </div>
                    </div>
                    <div class="pb-20">
                        <table class="data-table table stripe hover nowrap" id="CitiesTable">
                            <thead>
                                <tr>
                                    <th class="table-plus datatable-nosort">No</th>
                                    <th>Country</th>
                                    <th>Name</th>
                                    <th class="datatable-nosort">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <!-- Simple Datatable End -->
            </div>
        </div>
    </div>
@push('modals')
<div class="modal fade bs-example-modal-lg" id="CityModel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content"></div>
    </div>
</div>
@endpush
@endsection
@section('scripts')
<script type="text/javascript">
    window.list = "{!! route('admin.city.index') !!}";
</script>
<script src="{!! asset('js/cities.js') !!}" type="text/javascript"></script>
@endsection
