<div class="modal" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Customer</h5>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Customer Name *</label>
                                <input type="text" class="form-control" id="customerName">
                                <label class="form-label">Customer Email *</label>
                                <input type="text" class="form-control" id="customerEmail">
                                <label class="form-label">Customer Mobile *</label>
                                <input type="text" class="form-control" id="customerMobile">
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="SaveCustomer()" id="save-btn" class="btn btn-sm  btn-success" >Save</button>
                </div>
            </div>
    </div>
</div>


<script>
   async function SaveCustomer(){
      
    let customerName = document.getElementById('customerName').value;
    let customerEmail = document.getElementById('customerEmail').value;
    let customerMobile = document.getElementById('customerMobile').value;
    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if(customerName.length === 0){
        errorToast("Name Required");
    }
    else if(customerEmail.length === 0){
        errorToast("Email Required");
    }
    else if(!emailRegex.test(customerEmail)){
             errorToast('Enter Valid Email');
     }
    else if(customerMobile.length === 0){
        errorToast("Mobile number Required");
    }
     else{
        document.getElementById('modal-close').click();
          showLoader();
        
       
         let res = await axios.post('/create-customer',{
             name:customerName,
             email:customerEmail,
            mobile:customerMobile });

        hideLoader();
        document.getElementById('modal-close').click();

        if(res.status===200 && res.data['status']==='success'){
            successToast(res.data['message']);
            document.getElementById('save-form').reset();
            await getCustomerList();
           
           
          }
          else{
              errorToast(res.data['message']);
             }
         }
     }

</script>
