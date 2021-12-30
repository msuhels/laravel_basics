@extends('layouts.app')

@section("page-title") 
    Update School 
@endsection

@section("page-style")
@endsection

@section('page-content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <span class="card-title">Update School</span>
                        <div class="float-right">
                            <a class="btn btn-primary button-normal-trans" href="{{ route('schools.index') }}"> Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('schools.update', $school->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('school.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section("page-script")   
@endsection
