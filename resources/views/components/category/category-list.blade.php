<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-5 py-5">
            <div class="row justify-content-between ">
                <div class="align-items-center col">
                    <h4>Category</h4>
                </div>
                <div class="align-items-center col">
                    <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-end btn m-0 btn-sm bg-gradient-primary">Create</button>
                </div>
            </div>
            <hr class="bg-dark "/>
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
    getList();
    async function getList(){
        showLoader();
        let res = await axios.get('/catagory-list');
        hideLoader();

      //  let tableList = document.getElementById('tableList');
      //  let tableData = document.getElementById('tableData');

        //dataTable jquery diye cole. tai  document.getElementById diye dhorle pblm hobe, tai jquery diye dhorte hobe
        let tableList =$('#tableList');
        let tableData = $('#tableData');
        
        //aboding data repeating
       tableData.DataTable().destroy();
        tableList.empty();

        res.data.forEach(function (item,index){
           
            let row=`<tr>
                <td>${index+1} </td>
                <td>${item['name']} </td>
                 <td>
                    <button data-id = "${item['id']}" data-name = "${item['name']}" class = "btn editBtn btn-sm btn-outline-success" >Edit</button>
                    <button data-id = "${item['id']}"  class ="btn deleteBtn btn-sm btn-danger ">Delete</button>
                     </td>
                </tr>`
                tableList.append(row)

        })

   // document.getElementByClassName('editBtn')
   // document.getElementByClassName('deleteBtn')
  //evabe na kore jqure diye dhorte hobe.

  $('.editBtn').on('click', function (){
    let id = $(this).data('id');
    let name = $(this).data('name');
    $('#update-modal').modal('show');
       $('#updateID').val(id);
      $('#categoryNameUpdate').val(name);
  })



  $('.deleteBtn').on('click', function (){
    let id = $(this).data('id');
    $('#delete-modal').modal('show');
    $('#deleteID').val(id);

    //optional: input type a id ta set korar jonno use kora hoy .val
    //d-none kete deya hoyeche, tai input form dekha zabe nah. eta sodo testing perpus aa kora hoy, id 
    // zacche ki na check korar jonno

    //oi input theke delete er somoy id nite hobe
 
})

     //evabe oo DataTable set kora zay
        //  tableData.DataTable({
        //      order:[[0,'asc']],
        //     lengthMenu:[5,10,15,20]
        //       })

             //evabe oo DataTable set kora zay
              new DataTable('#tableData',{
            order:[[0,'asc']],
           lengthMenu:[10,20,30,40]

           });

    }
</script>

