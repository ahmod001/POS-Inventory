<div class="modal" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Customer</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Customer Name *</label>
                                <input type="text" class="form-control" id="customerNameUpdate">
                                <label class="form-label">Customer Email *</label>
                                <input type="text" class="form-control" id="customerEmailUpdate">
                                <label class="form-label">Customer Mobile *</label>
                                <input type="text" class="form-control" id="customerMobileUpdate">
                                <input type="text" class="d-none" id="updateID">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
                <button onclick="Update()" id="update-btn" class="btn btn-sm  btn-success">Update</button>
            </div>
        </div>
    </div>
</div>


<script>
    async function FillUpUpdateForm(id) {
        document.getElementById('updateID').value = id;
        showLoader();
        const res = await axios.get(`/customers/${id}`)
        hideLoader();
        document.getElementById('customerNameUpdate').value = res.data['name'];
        document.getElementById('customerEmailUpdate').value = res.data['email'];
        document.getElementById('customerMobileUpdate').value = res.data['mobile'];
    }



    async function Update() {

        const customerName = document.getElementById('customerNameUpdate').value;
        const customerEmail = document.getElementById('customerEmailUpdate').value;
        const customerMobile = document.getElementById('customerMobileUpdate').value;
        const updateID = document.getElementById('updateID').value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;


        if (customerName.length === 0) {
            errorToast("Customer Name Required !")
        } else if (customerEmail.length === 0) {
            errorToast("Customer Email Required !")
        } else if (!emailRegex.test(customerEmail)) {
            errorToast('Enter Valid Email');
        } else if (customerMobile.length === 0) {
            errorToast("Customer Mobile Required !")
        } else {

            document.getElementById('update-modal-close').click();

            showLoader();

            try {
                const res = await axios.post("/update-customer", {
                    name: customerName,
                    email: customerEmail,
                    mobile: customerMobile,
                    id: updateID
                })

                hideLoader();
                successToast(res.data['message']);
                document.getElementById("update-form").reset();

                await getCustomerList();
            } catch (error) {
                errorToast('Customer updating failed');
            }


        }
    }
</script>
