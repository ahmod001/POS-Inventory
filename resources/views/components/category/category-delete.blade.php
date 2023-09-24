<div class="modal" id="delete-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3 class=" mt-3 text-warning">Delete !</h3>
                <p class="mb-3">Once delete, you can't get it back.</p>
                <input class="d-none" id="deleteID" />
            </div>
            <div class="modal-footer justify-content-end">
                <div>
                    <button type="button" id="delete-modal-close" class="btn shadow-sm btn-secondary"
                        data-bs-dismiss="modal">Cancel</button>
                    <button onclick="itemDelete()" type="button" id="confirmDelete"
                        class="btn shadow-sm btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    async function itemDelete() {
        const categoryId = document.getElementById("deleteID").value;

        //  Close Modal
        document.getElementById('delete-modal-close').click();

        showLoader();
        try {
            const res = await axios.post('/delete-category', {
                id: categoryId
            })
            hideLoader();
            successToast(res.data['message']);
            await getCategoryList();
        } catch (error) {
            hideLoader();
            errorToast('Category deleting failed')
        }
        
    }
</script>
