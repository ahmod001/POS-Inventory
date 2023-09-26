<div class="modal" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">


                                <label class="form-label">Category</label>
                                <select type="text" class="form-control form-select" id="productCategoryUpdate">
                                    <option value="">Select Category</option>
                                </select>

                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" id="productNameUpdate">
                                <label class="form-label">Price</label>
                                <input type="text" class="form-control" id="productPriceUpdate">
                                <label class="form-label">Unit</label>
                                <input type="text" class="form-control" id="productUnitUpdate">
                                <br />
                              <label for="productImgUpdate">
                                <img class="w-15" id="oldImg" src="{{ asset('images/default.jpg') }}" />
                              </label>
                                <br />
                                <label class="form-label">Image</label>
                                <input oninput="handleUpdateImgPreviw(event)"
                                    accept="image/jpeg,image/jpg, image/png, image/webp" type="file"
                                    class="form-control" id="productImgUpdate">

                                <input type="text" class="d-none" id="updateId">
                                <input type="text" class="d-none" id="filePath">


                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button id="update-modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
                <button onclick="handleUpdate()" id="update-btn" class="btn btn-sm btn-success">Update</button>
            </div>

        </div>
    </div>
</div>


<script>
    const updateFillCategoryDropDown = async () => {
        const categoryDropdown = document.getElementById('productCategoryUpdate');

        // Reset category option before Dom
        categoryDropdown.innerHTML = '';

        try {
            const res = await axios.get('/category-list');
            res['data']['data'].map(category => {
                categoryDropdown.innerHTML += (
                    `<option value="${category['id']}">
                        ${category['name']}
                    </option>`);
            })
        } catch (error) {
            console.log(error);
        }
    }

    const FillUpUpdateForm = async (id, filePath) => {

        document.getElementById('updateId').value = id;
        document.getElementById('filePath').value = filePath;
        document.getElementById('oldImg').src = filePath;

        showLoader();
        await updateFillCategoryDropDown();

        try {
            const res = await axios.get(`/products/${id}`);
            document.getElementById('productNameUpdate').value = res['data']['name'];
            document.getElementById('productPriceUpdate').value = res['data']['price'];
            document.getElementById('productUnitUpdate').value = res['data']['unit'];
            document.getElementById('productCategoryUpdate').value = res['data']['category_id'];
            hideLoader();
        } catch (error) {
            hideLoader();
            // Close Model
            setTimeout(() => {
                document.getElementById('update-modal-close').click();
            }, 1000);
            errorToast('Something went wrong');
        }

    }

    const handleUpdate = async () => {

        const productId = document.getElementById('updateId').value;
        const productCategory = document.getElementById('productCategoryUpdate').value;
        const productName = document.getElementById('productNameUpdate').value;
        const productPrice = document.getElementById('productPriceUpdate').value;
        const productUnit = document.getElementById('productUnitUpdate').value;
        const productImg = document.getElementById('productImgUpdate').files[0];
        const productOldImgUrl = document.getElementById('filePath').value;

        // Validation
        if (productCategory.length === 0) {
            errorToast("Product category selection required")
        } else if (productName.length === 0) {
            errorToast("Product name is required")
        } else if (productPrice.length === 0) {
            errorToast("Product price is required")
        } else if (productUnit.length === 0) {
            errorToast("Product unit is required")
        } else {

            // Close Model
            document.getElementById('update-modal-close').click();

            // Genarate Form Data
            const formData = new FormData();
            formData.append('id', productId);
            formData.append('img', productImg);
            formData.append('old_img', productOldImgUrl);
            formData.append('name', productName);
            formData.append('price', productPrice);
            formData.append('unit', productUnit);
            formData.append('category_id', productCategory);

            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            };
            showLoader();
            try {
                const res = await axios.post('/update-product', formData, config);
                hideLoader();
                // Refresh Table
                await getProductList();
                successToast(res['data']['message']);
            } catch (error) {
                hideLoader();
                console.log(error);
                errorToast('Product creation failed');
            }
        }
    }

    const handleUpdateImgPreviw = (e) => {
        const previwImg = document.getElementById('oldImg');
        // sessionStorage.setItem('old_img_url', previwImg.src);

        const imgUrl = window.URL.createObjectURL(e.target.files[0]);
        previwImg.src = imgUrl;
    }
</script>
