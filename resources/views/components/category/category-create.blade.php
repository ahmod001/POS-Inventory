<div class="modal" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Category Name *</label>
                                <input type="text" class="form-control" id="categoryName">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
                <button onclick="handleSave()" id="save-btn" class="btn btn-sm  btn-success">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    const handleSave = async () => {
        const categoryName = document.getElementById('categoryName').value;

        // Validation
        if (categoryName.length === 0) {
            errorToast("Category name is Required");
        } else {
            // Close model
            document.getElementById('modal-close').click();
            
            showLoader();
            try {
                const res = await axios.post('/create-category', {
                    name: categoryName
                })
                hideLoader();
                successToast(res.data['message'])
                document.getElementById('save-form').reset();
                await getCategoryList();
            } catch (error) {
                hideLoader();
                errorToast('Category creation failed')
            }
        }
    }
</script>
