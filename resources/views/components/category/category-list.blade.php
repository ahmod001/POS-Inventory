<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5">
                <div class="row justify-content-between ">
                    <div class="align-items-center col">
                        <h4>Category</h4>
                    </div>
                    <div class="align-items-center col">
                        <button data-bs-toggle="modal" data-bs-target="#create-modal"
                            class="float-end btn m-0 btn-sm bg-gradient-primary">Create</button>
                    </div>
                </div>
                <hr class="bg-dark " />
                <table class="table" id="tableData">
                    <thead>
                        <tr class="bg-light">
                            <th>No</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableList">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    const getCategoryList = async () => {
        showLoader();
        try {
            let res = await axios.get('/category-list');
            showData(res['data']['data'])
            hideLoader();
        } catch (error) {
            errorToast('Something went wrong');
            hideLoader();
        }

    }
    getCategoryList();

    const showData = (data) => {
        const tableList = $('#tableList');
        const tableData = $('#tableData');

        //aboding data repeating
        tableData.DataTable().destroy();
        tableList.empty();

        // Render Rows
        data.map((item, index) => {
            tableList.append(`<tr>
                <td>${index+1} </td>
                <td>${item['name']} </td>
                 <td>
                    <button data-id = "${item['id']}" data-name = "${item['name']}" class = "btn editBtn btn-sm btn-outline-success" >Edit</button>
                    <button data-id = "${item['id']}"  class ="btn deleteBtn btn-sm btn-danger ">Delete</button>
                     </td>
                </tr>`)
        })

        // Edit Btn Handler
        $('.editBtn').on('click', function() {
            let id = $(this).data('id');
            let name = $(this).data('name');
            $('#update-modal').modal('show');
            $('#updateID').val(id);
            $('#categoryNameUpdate').val(name);
        })

        // Delete Btn Handler
        $('.deleteBtn').on('click', function() {
            let id = $(this).data('id');
            $('#delete-modal').modal('show');
            $('#deleteID').val(id);

        })

        // Initalizing JQuery Data table 
        new DataTable('#tableData', {
            order: [
                [0, 'asc']
            ],
            lengthMenu: [10, 20, 30, 40]
        });

    }
</script>
