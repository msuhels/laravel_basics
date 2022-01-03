@extends('layouts.app')

@section("page-title") School @endsection

@section("page-style")
@endsection

@section('page-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-top-header">      

                            <span id="card_title">
                                {{ __('School') }} ({{ $schools->total() }})

                            </span>

                             <div class="float-right">
                                <a href="{{ route('schools.create') }}" class="btn btn-primary btn-sm float-right button-normal-trans"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                <div class="card">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div>
                            <span class="spanTab">All</span>
                        </div>
                        <hr/>
                        <form method="get">
                            <div class="row"> 
                                <div class="col-sm-5">
                                 <div class="form-group">   
                                        <input type="text" name="s" class="form-control form-control-sm" id="search" aria-describedby="emailHelp" placeholder="Search by ID"
                                        value="{{ 
                                                (app('request')->input('s')) ? 
                                                app('request')->input('s') : ''
                                                }}"
                                        >    
                                  </div>
                                </div>
                                 <div class="col-sm-5">   
                                    <div class="form-group">   
                                        <input type="text" name="createdat" class="form-control form-control-sm"  aria-describedby="" 
                                        onfocus="(this.type='date')"
                                        placeholder="Search by Created Date"
                                        value="{{ 
                                                (app('request')->input('createdat')) ? 
                                                app('request')->input('createdat') : ''
                                                }}"
                                        >    
                                    </div>
                                </div>
                                <div class="col-sm-2 ">   
                                    <button type="submit" class="btn btn-sm btn-primary button-normal-trans" title="Search">
                                        <i class="fa fa-fw fa-search"></i> 
                                        
                                    </button>
                                    <a href="{{url()->current()}}" class="btn btn-sm btn-success button-normal-trans" title="Reset">
                                        <i class="fa fa-fw fa-redo"></i> 
                                    </a>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>
                                            <input type="checkbox" 
                                            class="selectAllRow" 
                                            onclick="selectAllRow()"
                                            name="all">
                                        </th>
                                        
										<th><a class="tablehead" href='{{ request()->fullUrlWithQuery(["sortby" => "name", "orderby" => (app("request")->input("orderby") && app("request")->input("orderby") == "asc") ? "desc" : "asc"])  }}'>Name
                @if(app("request")->input("orderby") == "desc" && app("request")->input("sortby") == "name")  
                    @if(app("request")->input("sortby") == "name")
                        <i class="fal fa-angle-down sortArrow selectArrow"></i>
                    @else
                        <i class="fal fa-angle-down sortArrow "></i>
                    @endif
                @else
                    @if(app("request")->input("sortby") == "name")
                        <i class="fal fa-angle-up sortArrow selectArrow"></i>
                    @else
                        <i class="fal fa-angle-up sortArrow"></i>
                    @endif
                @endif
                </a>
            </th>
										<th><a class="tablehead" href='{{ request()->fullUrlWithQuery(["sortby" => "location", "orderby" => (app("request")->input("orderby") && app("request")->input("orderby") == "asc") ? "desc" : "asc"])  }}'>Location
                @if(app("request")->input("orderby") == "desc" && app("request")->input("sortby") == "location")  
                    @if(app("request")->input("sortby") == "location")
                        <i class="fal fa-angle-down sortArrow selectArrow"></i>
                    @else
                        <i class="fal fa-angle-down sortArrow "></i>
                    @endif
                @else
                    @if(app("request")->input("sortby") == "location")
                        <i class="fal fa-angle-up sortArrow selectArrow"></i>
                    @else
                        <i class="fal fa-angle-up sortArrow"></i>
                    @endif
                @endif
                </a>
            </th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($schools as $school)
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="selectRow" name="row_{{$i++}}">
                                            </td>
                                            
											<td>{{ $school->name }}</td>
											<td>{{ $school->location }}</td>

                                            <td>
                                                <form action="{{ route('schools.destroy',$school->id) }}" method="POST" id="actionForm" class="marginBottom0">
                                                    <a class="btn btn-sm btn-primary button-normal-trans" href="{{ route('schools.show',$school->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success button-normal-trans" href="{{ route('schools.edit',$school->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm button-delete-trans" onclick="deleteConfirm()"><i class="fa fa-fw fa-trash confirmDelete" ></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-center">
                    {!! $schools->links('pagination::bootstrap-4') !!}
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function deleteConfirm(){
            
            var result = confirm("Want to delete?");
            if (result) {
                document.getElementById("actionForm").submit();
            }

        }

        function selectAllRow() {
            var checkAllBox = document.getElementsByClassName("selectAllRow")[0];
            var rowCheckBox = document.getElementsByClassName("selectRow");

            var setValue = (checkAllBox.checked == true) ? true : false;

            for(var i=0; i< rowCheckBox.length; i++){
                    rowCheckBox[i].checked = setValue;
            }
            
        }
    </script>
@endsection
@section("page-script")   
@endsection