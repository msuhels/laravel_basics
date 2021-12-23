

function submitForm(){
   
    var formData = new FormData(document.getElementById("addForm"));
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
            bindPagination();
        })
        
      .catch(function (error) {
        console.log(error);
      });

}

function bindPagination(e){ 
    const btn = document.querySelectorAll(".page-link");
    for (i = 0; i < btn.length; i++) {
        btn[i].addEventListener('click',function(e) {
            e.preventDefault();
            document.querySelector('li').classList.remove('active');
            this.parentElement.classList.add('active');
            var page = this.href.split('page=')[1];
            var status = this.href.split('status=')[1];
            var search = this.href.split('search=')[1];
            getList(page,search,status);
        });
    }  
}



window.onload = function() {

setTimeout(function(){
    getList();    
}, 1000);

        setTimeout(function(){

            //search record
            document.getElementById("getCrudList").onclick = function()
            {
                var url = document.getElementById("searchCrud").querySelector("#listUrl").value;
                var search = document.getElementById("searchCrud").querySelector("#search").value;
                var status = document.getElementById("searchCrud").querySelector("#status").value;
                getList(1,search,status); 
                        
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



