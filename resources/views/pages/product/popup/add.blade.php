<div class="modal fade" id="addFormModal" tabindex="-1" aria-labelledby="addFormModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="addFormModalLabel">Modal title</h5>
        <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="addForm" method="POST" enctype="multipart/form-data">
                <input name="title" type="text" class="form-control" 
                    id="" required="required" value="" placeholder="Title" >
                
                <input name="price" type="text" class="form-control" 
                    id="" required="required" value="" placeholder="Price" >
                
                <input type="hidden" name="url" id="addUrl" value="add-product-data" />
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                <button type="button" class="btn btn-success" data-bs-toggle="modal" 
                    onclick="submitForm()"
                    data-bs-target="#addFormModal">Save</button>
            </form>
        
        </div>
        <div class="modal-footer">
        
        </div>
    </div>
    </div>
</div>
