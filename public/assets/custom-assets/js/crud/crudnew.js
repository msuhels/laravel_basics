

function submitForm(){
   
    var form_data = new FormData(document.getElementById("addForm"));
    var url = document.getElementById("addForm").querySelector("#addUrl").value;
   
    axios.post(url, formData)
      .then(function (response) {
        alert(response.data.message);
        location.reload();
      })
      .catch(function (error) {
        console.log(error);
      });

}

function editSubmitForm(){

    var formData = new FormData(document.getElementById("updateForm"));
    var url = document.getElementById("updateForm").querySelector("#editUrl").value;

    axios.post(url, formData)
      .then(function (response) {
        alert(response.data.message);
        location.reload();
      })
      .catch(function (error) {
        console.log(error);
      });
}




function getList(page=1,search='',status=''){
    
    var url = document.getElementById("searchCrud").querySelector("#listUrl").value;
    
    axios.get(url+"?page="+ page+"&search="+search+"&status="+status)
      .then(function (response) {
        document.getElementById('data-list').innerHTML = response.data;
      })
      .catch(function (error) {
        console.log(error);
      });

}



window.onload = function() {

setTimeout(function(){
    getList();    
}, 2000);

        setTimeout(function(){

            //get record
            // var editEle = document.querySelectorAll('.edit');
            // console.log("elements ",editEle.length);
            // for(var i = 0; i < editEle.length; i++) {
            //     var editClass = editEle[i];
            //     editClass.onclick = function() {
            //         var Id = this.getAttribute('data-id');
            //         var Url = this.getAttribute("data-value");
            //         showRecord(Id,Url);
            //     }
            // }

            //delete record
            // var deleteEle = document.querySelectorAll('.delete');
            // console.log("delete ",deleteEle.length);
            // for(var i = 0; i < deleteEle.length; i++) {
            //     var deleteClass = deleteEle[i];
            //     deleteClass.onclick = function() {
            //         var Id = this.getAttribute('data-id');
            //         var Url = this.getAttribute("data-value");
            //         deleteRecord(Id,Url);
            //     }
            // }

            //search record
            document.getElementById("getCrudList").onclick = function()
            {
                var url = document.getElementById("searchCrud").querySelector("#listUrl").value;
                var search = document.getElementById("searchCrud").querySelector("#search").value;
                var status = document.getElementById("searchCrud").querySelector("#status").value;
                getList(1,search,status); 
                        
            }

            //pagination
            var pagination = document.querySelectorAll('.pagination a.page-link');
            
            for(var i = 0; i < pagination.length; i++) {
                var p = pagination[i];
                // p.onclick = function(e) {
                //     e.preventDefault();
                    
                //         document.querySelector('li').classList.remove('active');
                //         this.parentElement.classList.add('active');
                //         var page = this.href.split('page=')[1];
                //         var status = this.href.split('status=')[1];
                //         var search = this.href.split('search=')[1];
                //         getList(page,status,search);
                // }
                p.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                        document.querySelector('li').classList.remove('active');
                        this.parentElement.classList.add('active');
                        var page = this.href.split('page=')[1];
                        var status = this.href.split('status=')[1];
                        var search = this.href.split('search=')[1];
                        getList(page,status,search);
                });
            }

        }, 3000);
    }


function showRecord(Id="",Url="") {

var editModal = document.getElementById('editFormModal');
var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    axios.post(Url, {
                _token:CSRF_TOKEN,
                id:Id,
                })
      .then(function (response) {
        document.getElementById('edit-crud-modal-body').innerHTML = response.data;
        //$('#editFormModal').modal('show');
      })
      .catch(function (error) {
        console.log(error);
      });

}

function deleteRecord(Id="",Url="") {

var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
var is_deleted = 1;

    axios.post(Url, {
                _token:CSRF_TOKEN,
                id:Id,
                is_deleted:is_deleted,
                })
      .then(function (response) {
        location.reload();
      })
      .catch(function (error) {
        console.log(error);
      });

}



