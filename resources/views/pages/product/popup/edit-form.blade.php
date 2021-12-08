<form id="updateForm" method="POST" enctype="multipart/form-data">
    <input name="title" type="text" class="form-control" 
        id="" required="required"  placeholder="Title" 
        value="{{$data->title}}"
    >
    
    <input name="price" type="text" class="form-control" 
        id="" required="required"  placeholder="price" 
        value="{{$data->price}}"    
    >
    
    <input name="image" type="file" class="form-control" 
        id=""   placeholder="Image" >
    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
    <input type="hidden" name="id" id="id" value="{{ $data->id }}" />
    <button type="button" class="btn btn-success" data-bs-toggle="modal" 
        onclick="editSubmitForm()"
        data-bs-target="#editFormModal">Save</button>
</form>