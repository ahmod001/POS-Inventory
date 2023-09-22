<div class="modal" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Category Name *</label>
                                <input type="text" class="form-control" id="categoryNameUpdate">
                                <input class="d-none"  id="updateID">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="Update()" id="update-btn" class="btn btn-sm  btn-success" >Update</button>
            </div>
        </div>
    </div>
</div>

<script>
    async function Update() {
        let updatedCatagoryName = document.getElementById('categoryNameUpdate').value;
        let categoryid = document.getElementById('updateID').value;

       

        if(updatedCatagoryName.length === 0) {
           errorToast("Provide Category Name");
          }else{
          

            showLoader();
            let res = await axios.post('/update-category',{id:categoryid,
                name:updatedCatagoryName})
            hideLoader();
         if(res.status === 200 && res.data['status']==='success'){
            document.getElementById('update-modal-close').click();
            successToast(res.data['message']);
           await getList();
           }else{
            errorToast(res.data['message']);
         }
      }
        
     }
 

</script>
