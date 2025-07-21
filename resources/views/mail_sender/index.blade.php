@extends('layout.app')

@section('title')
    Mail Sender
@endsection


@section('content')
    <div class="pagetitle">
        <h1>Mail Sender</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Mail Sender</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="card">
            <div class="card-title">Mail Sender | All </div>

            <div class="card-body">


            <form method="post" action="{{ route('mail_sender.send') }}" enctype="multipart/form-data" >
                @csrf

                <div class="row">

                    <div class="col-md-4 mb-2">
                        <div class="form-group">
                            <label for="form-label">Excel File Upload </label>
                            <input type="file" class="form-control"  name="email_file" accept=".xlsx,.csv" required>
                        </div>
                    </div>


                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Upload & Send</button>
                        
                    </div>
                </div>


            </form>



              




            </div>
        </div>
    </div>
@endsection
