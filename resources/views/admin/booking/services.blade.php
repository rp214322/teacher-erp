@extends('admin.layouts.app')

@section('title', 'Services')

@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="pd-20 card-box mb-30">
                <h5 class="h5"><strong>Booking ID:</strong> {{ $booking->id }}</h5>
                <h3 class="text-blue h3"><strong>Booking Details</strong></h3>
                <hr>
                <h4 class="text-blue h4"><strong>Contact Details</strong></h4>
                <h6 class="h6"><strong>Client Name:</strong> {{ $booking->name }}</h6>
                <h6 class="h6"><strong>Contact Number:</strong> {{ $booking->contact }}</h6>
                <h6 class="h6"><strong>Client Email:</strong> {{ $booking->email }}</h6>
                <h6 class="h6"><strong>No Of Passengers:</strong> {{ $booking->no_of_passengers }}</h6>
                <h6 class="h6"><strong>Start Date:</strong> {{ $booking->start_date }}</h6>
                <h6 class="h6"><strong>End Date:</strong> {{ $booking->end_date }}</h6>
                <h6 class="h6"><strong>Currency:</strong> {{ $booking->currency }}</h6>
                <h6 class="h6"><strong>Amount:</strong> {{ $booking->amount }}</h6>
                <h4 class="text-blue h4"><strong>Agency Information</strong></h4>
                <h6 class="h6"><strong>Agency Name:</strong> {{ $booking->agent->agency_name }}</h6>
                <h6 class="h6"><strong>Agent Name:</strong> {{ $booking->agent->name }}</h6>
            </div>
            <div class="min-height-200px">
                <!-- Simple Datatable start -->
                {{-- Hotel --}}
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix mb-20">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Hotels</h4>
                        </div>
                        <div class="pull-right">
                            <a href="javascript:;" class="fill_data_hotel btn btn-primary"
                                data-url="{{ route('admin.hotelbooking.create', ['booking_id' => $booking->id]) }}"
                                data-method="get">
                                Add Hotel
                            </a>
                        </div>
                    </div>
                    <div class="pb-20">
                        <table class="data-table table stripe hover nowrap" id="HotelBookingsTable">
                            <thead>
                                <tr>
                                    <th class="table-plus datatable-nosort">No</th>
                                    <th>Hotel Name</th>
                                    <th>Check-in Date</th>
                                    <th>Check-out Date</th>
                                    <th>No of Room</th>
                                    <th>Room Type</th>
                                    <th>Meal Plan</th>
                                    <th>Voucher Ref</th>
                                    <th class="datatable-nosort">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                {{-- Hotel --}}
                <!-- Simple Datatable End -->
                <!-- Simple Datatable start -->
                {{-- Tour --}}
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix mb-20">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Tours</h4>
                        </div>
                        <div class="pull-right">
                            <a href="javascript:;" class="fill_data_tour btn btn-primary"
                                data-url="{{ route('admin.tourbooking.create', ['booking_id' => $booking->id]) }}"
                                data-method="get">
                                Add Tour
                            </a>
                        </div>
                    </div>
                    <div class="pb-20">
                        <table class="data-table table stripe hover nowrap" id="TourBookingsTable">
                            <thead>
                                <tr>
                                    <th class="table-plus datatable-nosort">No</th>
                                    <th>Tour Name</th>
                                    <th>Tour Date</th>
                                    <th>Time</th>
                                    <th>No of Passengers</th>
                                    <th>Voucher Ref</th>
                                    <th class="datatable-nosort">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                {{-- Tour --}}
                <!-- Simple Datatable End -->
                <!-- Simple Datatable start -->
                {{-- Transfer --}}
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix mb-20">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Transfers</h4>
                        </div>
                        <div class="pull-right">
                            <a href="javascript:;" class="fill_data btn btn-primary" data-url="#" data-method="get">
                                Add Transfer
                            </a>
                        </div>
                    </div>
                    <div class="pb-20">
                        <table class="data-table table stripe hover nowrap" id="TransferBookingsTable">
                            <thead>
                                <tr>
                                    <th class="table-plus datatable-nosort">No</th>
                                    <th>Date</th>
                                    <th>Pick-up Time</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Voucher Ref</th>
                                    <th class="datatable-nosort">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                {{-- Transfer --}}
                <!-- Simple Datatable End -->
                <!-- Simple Datatable start -->
                {{-- Misc --}}
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix mb-20">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Misc</h4>
                        </div>
                        <div class="pull-right">
                            <a href="javascript:;" class="fill_data_misc btn btn-primary"
                                data-url="{{ route('admin.miscbooking.create', ['booking_id' => $booking->id]) }}"
                                data-method="get">
                                Add Misc
                            </a>
                        </div>
                    </div>
                    <div class="pb-20">
                        <table class="data-table table stripe hover nowrap" id="MiscBookingsTable">
                            <thead>
                                <tr>
                                    <th class="table-plus datatable-nosort">No</th>
                                    <th>Misc Name</th>
                                    <th>Services Date</th>
                                    <th>Time</th>
                                    <th>No of Passengers</th>
                                    <th>Country</th>
                                    <th>City</th>
                                    <th>Voucher Ref</th>
                                    <th class="datatable-nosort">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                {{-- Misc --}}
                <!-- Simple Datatable End -->
            </div>
            <div class="pd-20 card-box mb-30">
                <div class="clearfix mb-20">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Remark</h4>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group" id="remarksList">
                        @forelse ($booking->remarks as $remark)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remark{{ $remark->id }}"
                                        {{ $remark->status == 0 ? 'checked' : '' }}
                                        onchange="toggleRemarkStatus({{ $remark->id }}, this)">
                                    <label class="form-check-label {{ $remark->status == 0 ? 'checked' : '' }}"
                                        for="remark{{ $remark->id }}">
                                        {{ $remark->remarks }}
                                    </label>
                                </div>
                                <span class="delete-btn" onclick="deleteRemark({{ $remark->id }})">&#10006;</span>
                            </li>
                        @empty
                            <li class="list-group-item">No Remark Found</li>
                        @endforelse
                    </ul>
                </div>
                <div class="card-footer">
                    <input type="text" class="form-control" id="newRemarkInput"
                        placeholder="Enter new remark and press Enter">
                </div>
            </div>
        </div>
    </div>
    </div><!-- /# card -->
    </section>
    @push('modals')
        <div class="modal fade bs-example-modal-lg" id="HotelBookingModel" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content"></div>
            </div>
        </div>
        <div class="modal fade bs-example-modal-lg" id="TourBookingModel" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content"></div>
            </div>
        </div>
        <div class="modal fade bs-example-modal-lg" id="TransferBookingModel" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content"></div>
            </div>
        </div>
        <div class="modal fade bs-example-modal-lg" id="MiscBookingModel" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content"></div>
            </div>
        </div>
    @endpush
@endsection
@section('styles')
    <style>
        .form-check-label.checked {
            text-decoration: line-through;
        }

        .delete-btn {
            display: none;
            cursor: pointer;
            color: black;
        }

        .list-group-item:hover .delete-btn {
            display: inline;
        }
    </style>
@endsection
@section('scripts')
    <script type="text/javascript">
        window.list = "{{ route('admin.booking.show', $booking->id) }}";
        window.list1 = "{{ route('admin.singlehotelbooking', $booking->id) }}";
        window.list2 = "{{ route('admin.singletourbooking', $booking->id) }}";
        window.list3 = "{{ route('admin.singleservicesbooking', $booking->id) }}";
        window.fetchData = "{{ route('fetchData') }}";

        $(document).ready(function() {
            // Handle adding new remark
            $('#newRemarkInput').keypress(function(event) {
                if (event.key === 'Enter') {
                    const newText = $(this).val().trim();
                    if (newText) {
                        addRemark(newText);
                        $(this).val('');
                    }
                }
            });

            // Toggle remark status
            $('.form-check-input').change(function() {
                const remarkLabel = $(this).next('.form-check-label');
                if ($(this).is(':checked')) {
                    remarkLabel.addClass('checked');
                } else {
                    remarkLabel.removeClass('checked');
                }
            });
        });

        function addRemark(remarkText) {
            $.ajax({
                url: "{{ route('admin.remark.store', $booking->id) }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    remarks: remarkText,
                    status: 1
                },
                success: function(response) {
                    location.reload();
                },
                error: function(response) {
                    alert('Error adding remark');
                }
            });
        }

        function toggleRemarkStatus(remarkId, checkbox) {
            const status = checkbox.checked ? 0 : 1;
            $.ajax({
                url: `{{ route('admin.remark.update', ':id') }}`.replace(':id',
                    remarkId), // Replacing placeholder with actual ID
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status
                },
                success: function(response) {
                    const remarkLabel = $(checkbox).next('.form-check-label');
                    if (status == 0) {
                        remarkLabel.addClass('checked');
                    } else {
                        remarkLabel.removeClass('checked');
                    }
                },
                // error: function(response) {
                //     alert('Error updating remark status');
                // }
            });
        }

        function deleteRemark(remarkId) {
            if (confirm('Are you sure you want to delete this remark?')) {
                $.ajax({
                    url: `{{ route('admin.remark.delete', ':id') }}`.replace(':id', remarkId),
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        } else {
                            alert(response.error);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Error deleting remark: ' + xhr.responseJSON.error);
                    }
                });
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            // Handle checkbox change
            $('.form-check-input').change(function() {
                const remarkLabel = $(this).next('.form-check-label');
                if ($(this).is(':checked')) {
                    remarkLabel.addClass('checked');
                } else {
                    remarkLabel.removeClass('checked');
                }
            });

            // Add new remark on 'Enter' key press
            $('#newRemarkInput').keypress(function(event) {
                if (event.key === 'Enter') {
                    const newText = $(this).val().trim();
                    if (newText) {
                        const newRemarkItem = `
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox">
                                    <label class="form-check-label">${newText}</label>
                                </div>
                                <span class="delete-btn" onclick="deleteRemark(this)">&#10006;</span>
                            </li>
                        `;
                        $('#remarksList').append(newRemarkItem);
                        $(this).val('');

                        // Add event listener to new checkbox
                        $('.form-check-input').last().change(function() {
                            const remarkLabel = $(this).next('.form-check-label');
                            if ($(this).is(':checked')) {
                                remarkLabel.addClass('checked');
                            } else {
                                remarkLabel.removeClass('checked');
                            }
                        });
                    }
                }
            });
        });

        function deleteRemark(deleteBtn) {
            $(deleteBtn).closest('.list-group-item').remove();
        }
    </script>
    <script src="{{ asset('js/hotelbooking.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/bookings.js') }}" type="text/javascript"></script>
    <script src="{!! asset('js/tourbooking.js') !!}" type="text/javascript"></script>
    {{-- <script src="{!! asset('js/transferboking.js') !!}" type="text/javascript"></script> --}}
    <script src="{!! asset('js/miscbooking.js') !!}" type="text/javascript"></script>
@endsection
