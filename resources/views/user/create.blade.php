@extends('layout.app')

@section('title')
    User Create
@endsection


@section('content')
    <div class="pagetitle">
        <h1>User</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item">User</li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="card">
            <div class="card-title">User | Create </div>

            <div class="card-body">


                <form class="row" method="POST" id="form_validation" action="{{ route('user.store') }}"
                    autocomplete="off">

                    @csrf

                    <div class="row">

                        <div class="col-md-4 mb-2">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingName" name="name">
                                <label for="floatingName">User Name</label>
                            </div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="floatingEmail" name="email">
                                <label for="floatingEmail">User Email</label>
                            </div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <div class="form-floating">
                                <input type="password" class="form-control" id="floatingPassword" name="password">
                                <label for="floatingPassword">Password</label>
                            </div>
                        </div>


                       


                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                           
                        </div>
                    </div>

                </form>



            </div>
        </div>
    </div>
@endsection

@push('custom_js')
    <script>
        // alert('dfd');
    </script>
@endpush
