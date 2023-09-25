<div class="modal" id="delete-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3 class=" mt-3 text-warning">Delete !</h3>
                <p class="mb-3">Once delete, you can't get it back.</p>
                <input class="d-none" id="deleteID" />
                <input class="d-none" id="deleteFilePath" />
            </div>
            <div class="modal-footer justify-content-end">
                <div>
                    <button type="button" id="delete-modal-close" class="btn shadow-sm btn-secondary"
                        data-bs-dismiss="modal">Cancel</button>
                    <button onclick="handleDelete()" type="button" id="confirmDelete"
                        class="btn shadow-sm btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const handleDelete = async () => {
        const productId = document.getElementById("deleteID").value;
        const imgUrl = document.getElementById('deleteFilePath').value;

        //  Close Modal
        document.getElementById('delete-modal-close').click();

        showLoader();     
        try {
            const res = await axios.post('/delete-product', {
                id: productId,
                img_url: imgUrl
            })
            hideLoader();
            successToast(res.data['message']);
            await getProductList();
        } catch (error) {
            hideLoader();
            console.log(error);
            errorToast('Product deleting failed')

        }

    }
</script>
