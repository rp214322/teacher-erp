@extends('admin.layouts.app')

@section('title', 'CP')

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
                {{-- hotel --}}
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix mb-20">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Hotels</h4>
                        </div>
                    </div>
                    <div class="pb-20">
                        <table class="data-table table stripe hover nowrap">
                            <thead>
                                <tr>
                                    <th>Service</th>
                                    <th>Date</th>
                                    <th>Supplier</th>
                                    <th>Booking Date</th>
                                    <th>Due Date</th>
                                    <th>Currency</th>
                                    <th>Amount</th>
                                    <th>Edit</th>
                                    <th>Payment</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Car Rental</td>
                                    <td>2024-09-10</td>
                                    <td><input type="text" class="form-control" placeholder="Supplier"></td>
                                    <td><input type="date" class="form-control"></td>
                                    <td><input type="date" class="form-control"></td>
                                    <td><input type="text" class="form-control" placeholder="Currency"></td>
                                    <td><input type="text" class="form-control" placeholder="Amount"></td>
                                    <td><button class="btn btn-primary">Edit</button></td>
                                    <td><button class="btn btn-primary">Payment</button></td>
                                </tr>
                                <tr>
                                    <td>Concert Tickets</td>
                                    <td>2024-10-15</td>
                                    <td><input type="text" class="form-control" placeholder="Supplier"></td>
                                    <td><input type="date" class="form-control"></td>
                                    <td><input type="date" class="form-control"></td>
                                    <td><input type="text" class="form-control" placeholder="Currency"></td>
                                    <td><input type="text" class="form-control" placeholder="Amount"></td>
                                    <td><button class="btn btn-primary">Edit</button></td>
                                    <td><button class="btn btn-primary">Payment</button></td>
                                </tr>
                                <tr>
                                    <td>Excursion Package</td>
                                    <td>2024-08-25</td>
                                    <td><input type="text" class="form-control" placeholder="Supplier"></td>
                                    <td><input type="date" class="form-control"></td>
                                    <td><input type="date" class="form-control"></td>
                                    <td><input type="text" class="form-control" placeholder="Currency"></td>
                                    <td><input type="text" class="form-control" placeholder="Amount"></td>
                                    <td><button class="btn btn-primary">Edit</button></td>
                                    <td><button class="btn btn-primary">Payment</button></td>
                                </tr>
                                <tr>
                                    <td>Spa Treatment</td>
                                    <td>2024-11-20</td>
                                    <td><input type="text" class="form-control" placeholder="Supplier"></td>
                                    <td><input type="date" class="form-control"></td>
                                    <td><input type="date" class="form-control"></td>
                                    <td><input type="text" class="form-control" placeholder="Currency"></td>
                                    <td><input type="text" class="form-control" placeholder="Amount"></td>
                                    <td><button class="btn btn-primary">Edit</button></td>
                                    <td><button class="btn btn-primary">Payment</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- tour --}}
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix mb-20">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Tours</h4>
                        </div>
                    </div>
                    <div class="pb-20">
                        <table class="data-table table stripe hover nowrap">
                            <thead>
                                <tr>
                                    <th>Service</th>
                                    <th>Date</th>
                                    <th>Supplier</th>
                                    <th>Booking Date</th>
                                    <th>Due Date</th>
                                    <th>Currency</th>
                                    <th>Amount</th>
                                    <th>Edit</th>
                                    <th>Payment</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Car Rental</td>
                                    <td>2024-09-10</td>
                                    <td><input type="text" class="form-control" placeholder="Supplier"></td>
                                    <td><input type="date" class="form-control"></td>
                                    <td><input type="date" class="form-control"></td>
                                    <td><input type="text" class="form-control" placeholder="Currency"></td>
                                    <td><input type="text" class="form-control" placeholder="Amount"></td>
                                    <td><button class="btn btn-primary">Edit</button></td>
                                    <td><button class="btn btn-primary">Payment</button></td>
                                </tr>
                                <tr>
                                    <td>Concert Tickets</td>
                                    <td>2024-10-15</td>
                                    <td><input type="text" class="form-control" placeholder="Supplier"></td>
                                    <td><input type="date" class="form-control"></td>
                                    <td><input type="date" class="form-control"></td>
                                    <td><input type="text" class="form-control" placeholder="Currency"></td>
                                    <td><input type="text" class="form-control" placeholder="Amount"></td>
                                    <td><button class="btn btn-primary">Edit</button></td>
                                    <td><button class="btn btn-primary">Payment</button></td>
                                </tr>
                                <tr>
                                    <td>Excursion Package</td>
                                    <td>2024-08-25</td>
                                    <td><input type="text" class="form-control" placeholder="Supplier"></td>
                                    <td><input type="date" class="form-control"></td>
                                    <td><input type="date" class="form-control"></td>
                                    <td><input type="text" class="form-control" placeholder="Currency"></td>
                                    <td><input type="text" class="form-control" placeholder="Amount"></td>
                                    <td><button class="btn btn-primary">Edit</button></td>
                                    <td><button class="btn btn-primary">Payment</button></td>
                                </tr>
                                <tr>
                                    <td>Spa Treatment</td>
                                    <td>2024-11-20</td>
                                    <td><input type="text" class="form-control" placeholder="Supplier"></td>
                                    <td><input type="date" class="form-control"></td>
                                    <td><input type="date" class="form-control"></td>
                                    <td><input type="text" class="form-control" placeholder="Currency"></td>
                                    <td><input type="text" class="form-control" placeholder="Amount"></td>
                                    <td><button class="btn btn-primary">Edit</button></td>
                                    <td><button class="btn btn-primary">Payment</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- transfer --}}
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix mb-20">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Transfers</h4>
                        </div>
                    </div>
                    <div class="pb-20">
                        <table class="data-table table stripe hover nowrap">
                            <thead>
                                <tr>
                                    <th>Service</th>
                                    <th>Date</th>
                                    <th>Supplier</th>
                                    <th>Booking Date</th>
                                    <th>Due Date</th>
                                    <th>Currency</th>
                                    <th>Amount</th>
                                    <th>Edit</th>
                                    <th>Payment</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Car Rental</td>
                                    <td>2024-09-10</td>
                                    <td><input type="text" class="form-control" placeholder="Supplier"></td>
                                    <td><input type="date" class="form-control"></td>
                                    <td><input type="date" class="form-control"></td>
                                    <td><input type="text" class="form-control" placeholder="Currency"></td>
                                    <td><input type="text" class="form-control" placeholder="Amount"></td>
                                    <td><button class="btn btn-primary">Edit</button></td>
                                    <td><button class="btn btn-primary">Payment</button></td>
                                </tr>
                                <tr>
                                    <td>Concert Tickets</td>
                                    <td>2024-10-15</td>
                                    <td><input type="text" class="form-control" placeholder="Supplier"></td>
                                    <td><input type="date" class="form-control"></td>
                                    <td><input type="date" class="form-control"></td>
                                    <td><input type="text" class="form-control" placeholder="Currency"></td>
                                    <td><input type="text" class="form-control" placeholder="Amount"></td>
                                    <td><button class="btn btn-primary">Edit</button></td>
                                    <td><button class="btn btn-primary">Payment</button></td>
                                </tr>
                                <tr>
                                    <td>Excursion Package</td>
                                    <td>2024-08-25</td>
                                    <td><input type="text" class="form-control" placeholder="Supplier"></td>
                                    <td><input type="date" class="form-control"></td>
                                    <td><input type="date" class="form-control"></td>
                                    <td><input type="text" class="form-control" placeholder="Currency"></td>
                                    <td><input type="text" class="form-control" placeholder="Amount"></td>
                                    <td><button class="btn btn-primary">Edit</button></td>
                                    <td><button class="btn btn-primary">Payment</button></td>
                                </tr>
                                <tr>
                                    <td>Spa Treatment</td>
                                    <td>2024-11-20</td>
                                    <td><input type="text" class="form-control" placeholder="Supplier"></td>
                                    <td><input type="date" class="form-control"></td>
                                    <td><input type="date" class="form-control"></td>
                                    <td><input type="text" class="form-control" placeholder="Currency"></td>
                                    <td><input type="text" class="form-control" placeholder="Amount"></td>
                                    <td><button class="btn btn-primary">Edit</button></td>
                                    <td><button class="btn btn-primary">Payment</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- misc --}}
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix mb-20">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Miscellaneous Booking Services</h4>
                        </div>
                    </div>
                    <div class="pb-20">
                        @if ($miscbookings->isEmpty())
                            <p>No data found</p>
                        @else
                            <table class="data-table table stripe hover nowrap">
                                <thead>
                                    <tr>
                                        <th>Service</th>
                                        <th>Date</th>
                                        <th>Supplier</th>
                                        <th>Booking Date</th>
                                        <th>Due Date</th>
                                        <th>Currency</th>
                                        <th>Amount</th>
                                        <th>Edit</th>
                                        <th>Payment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($miscbookings as $miscbooking)
                                        <tr>
                                            <form action="{{ route('admin.miscbookingcosting.store', ['booking_id' => $booking->id]) }}" method="POST">
                                                @csrf
                                                <td>{{ $miscbooking->services_name }}</td>
                                                <td>{{ $miscbooking->services_date }}</td>
                                                <td>
                                                    <select name="supplier_id" class="form-control" required>
                                                        <option value="">Select Supplier</option>
                                                        @foreach (App\Models\Supplier::where('status', 1)->pluck('name', 'id')->toArray() as $id => $name)
                                                            <option value="{{ $id }}" {{ $miscbooking->supplier_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input type="date" name="booking_date" class="form-control" value="{{ $miscbooking->booking_date }}"></td>
                                                <td><input type="date" name="due_date" class="form-control" value="{{ $miscbooking->due_date }}"></td>
                                                <td>
                                                    <select name="currency" class="form-control" required>
                                                        <option value="">Select Currency</option>
                                                        @foreach (App\Models\MiscBookingCosting::$currency as $key => $value)
                                                            <option value="{{ $key }}" {{ $miscbooking->currency == $key ? 'selected' : '' }}>{{ $value }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input type="text" name="amount" class="form-control" placeholder="Amount" value="{{ $miscbooking->amount }}"></td>
                                                <td>
                                                    <input type="hidden" name="id" value="{{ $miscbooking->id }}">
                                                    <button type="submit" class="btn btn-primary">Edit</button>
                                                </td>
                                            </form>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#paymentModal" data-id="{{ $miscbooking->id }}">Payment</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
                
                <!-- Payment Modal -->
                <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="paymentModalLabel">Payment</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="paymentForm" action="" method="POST">
                                    @csrf
                                    <input type="hidden" name="miscbooking_id" id="miscbooking_id" value="">
                                    <!-- Add payment fields here -->
                                    <div class="form-group row">
                                        <label for="payment-method" class="col-sm-3 col-form-label">Payment Method</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="payment-method" name="payment_method" class="form-control" placeholder="COD" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="remarks" class="col-sm-3 col-form-label">Remarks</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="remarks" name="remarks" class="form-control" placeholder="Enter Remark" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="currency" class="col-sm-3 col-form-label">Currency</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="currency" name="currency" class="form-control" placeholder="INR" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="amount" class="col-sm-3 col-form-label">Amount</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="amount" name="amount" class="form-control" placeholder="5000" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="payment-date" class="col-sm-3 col-form-label">Payment Date</label>
                                        <div class="col-sm-9">
                                            <input type="date" id="payment-date" name="payment_date" class="form-control" placeholder="30-04-2024" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="transction-referance-number" class="col-sm-3 col-form-label">Transaction Referance Number</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="transction-referance-number" name="transaction_ref_no" class="form-control" placeholder="23fbdlk323jljf342j42l23j" required>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <script>
                    $('#paymentModal').on('show.bs.modal', function (event) {
                        var button = $(event.relatedTarget);
                        var miscbookingId = button.data('id');
                        var modal = $(this);
                        modal.find('#miscbooking_id').val(miscbookingId);
                    });
                </script>
                
                
            </div>
        </div>
    </div>
@endsection
