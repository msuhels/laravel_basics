function submitForm(){
    var formData = $("#addForm").serialize();
   
    $.ajax({
        type: "POST",
        url: "add-crud-data",
        data: formData,
        success: function(data) {
            if ( data.status == 200 ) {
                alert(data.message);
                location.reload();
            } else {
                alert(data.message);
            } 
        }
    });
}
function editSubmitForm(){
    var formData = $("#updateForm").serialize();
    console.log("formData",formData);
    $.ajax({
        type: "POST",
        url : "update-crud-data",
        data: formData,
        success: function(data) {
            if ( data.status == 200 ) {
                alert(data.message);
                location.reload();
            } else {
                alert(data.message);
            } 
        }
    });
}

$(document).ready(function() {
    getList();

    $(document).on('click', ".pagination a", function(e) {
            e.preventDefault();
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
            var page = $(this).attr('href').split('page=')[1];
            getList(page);
    });

    function getList(page=1){
        $.ajax({
            type: "GET",
            url : "get-crud-list?page="+ page,
            success: function(data) {
                $('.data-list').html(data);
                console.log("Pradeep");
            }
        });
    }
    $("body").on('click','.edit',function(){
        var Id = $(this).attr("data-id");
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: 'get-crud-record',
            type: 'POST',
            data: {
                    _token: CSRF_TOKEN, 
                    id:Id,
                    },
            dataType: 'text',
            success: function (data) { 
                $('.edit-crud-modal-body').html(data);
                $('#editFormModal').modal('show');
                console.log(data);
            }  
        });
    });


    $("body").on('click','.delete',function(){
        var Id = $(this).attr("data-id");
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var is_deleted = 1;

        if (confirm("Are you sure?")) {
            $.ajax({
            url: 'delete-crud',
            type: 'POST',
            data: {
                    _token: CSRF_TOKEN, 
                    id:Id,
                    is_deleted:is_deleted,
                    },
            dataType: 'JSON',
            success: function (data) { 
                if(data)
                  {
                    location.reload();
                  }
            }  
        });
        }
        
    });
});