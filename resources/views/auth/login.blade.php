@extends('layouts.guest')
@section('content')
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-12">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-primary">Welcome to Shayona Group of Institution</h2>
						</div>
						<form method="POST" action="{{ route('admin.post.login') }}">
                            @csrf
							<div class="input-group custom">
                                <input id="email" class="form-control form-control-lg" type="email" name="email" :value="old('email')" placeholder="Id" required autofocus />
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
								</div>
							</div>
							<div class="input-group custom">
                                <input id="password" class="form-control form-control-lg" type="password" name="password" placeholder="Password" required autocomplete="current-password" />
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group mb-0">
										<input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
@endsection
