@extends("layouts.app")

@section("page-title") List Page @endsection

@section("page-style")
@endsection

@section("page-content")      
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <div class="card">
                        <div class="card-body">
                           <form id="searchCrud" method="get" class="row g-3 topfilter">
                            <input class="form-control" type="hidden" name="page" id="page" value="1" >
                            <input type="hidden" name="url" id="listUrl" value="get-product-list" />
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                             <div class="col-md-2"> 
                                <input class="form-control" type="text" name="search" id="search" value="" placeholder="Search here...." >
                            </div>

                            <div class="col-md-2">
                               <select class="form-select form-select-md mb-3" name="status" id="status" aria-label=".form-select-lg example">
                                  <option value="">Status</option>
                                  <option value="1">Deleted</option>
                                  <option value="0">Not Deleted</option>
                                </select>
                            </div>

                            <div class="col-md-3">

                                <button type="button" class="btn btn-primary btn-sm mb-3 getCrudList" id="getCrudList"><i class="bx bx-search mr-1"></i>Go</button>
                                <a href="{{ url('/product-list')}}" class="btn btn-success btn-sm mb-3"><i class="bx bx-reset mr-1"></i>Reset</a>
                            </div>

                        </form> 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <button class="btn btn-primary" type="button" data-coreui-toggle="modal" data-coreui-target="#addFormModal">Add</button>
                            <!-- @include('pages.crud.crud-table') -->
                            <div class="data-list" id="data-list"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@include('pages.product.popup.add')
@include('pages.product.popup.edit-popup')
 
@endsection
@section("page-script")   
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="{{url('assets/custom-assets/js/crud/crudnew.js')}}"></script>
@endsection