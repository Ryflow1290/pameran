@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Profile') }}</h1>

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">

        <div class="col-lg-4 order-lg-2">

            

        </div>

        <div class="col-lg-8 order-lg-1">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Global Configuration</h6>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('config.toggle') }}" autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <input type="hidden" name="_method" value="POST">

                        <h6 class="heading-small text-muted mb-4">Toggle Rating Untuk Semua Pameran</h6>

                        <div class="pl-lg-4">
                            
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="isRatingOn" id="customCheck1" onclick="form.submit()" 
                            @forelse($config as $c) 
                                @if($c->key == 'isRatingOn' && $c->value == 'on') 
                                    checked 
                                @endif
                            @empty
                                <!-- value="false" -->
                            @endforelse
                            >
                            <label class="custom-control-label" for="customCheck1">Fitur Rating</label>
                        </div>
                            
                        </div>
                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection

@section('scripts')

@endsection