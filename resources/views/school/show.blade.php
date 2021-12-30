@extends('layouts.app')

@section("page-title") 
     {{ $school->name ?? 'Show School' }}
@endsection

@section("page-style")
@endsection

@section('page-content')

    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header btn-toolbar justify-content-between">
                        <div class="float-left">
                            <span class="card-title">Show School</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary button-normal-trans" href="{{ route('schools.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $school->name }}
                        </div>
                        <div class="form-group">
                            <strong>Location:</strong>
                            {{ $school->location }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
