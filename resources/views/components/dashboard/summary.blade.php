
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 animated fadeIn p-2">
                    <a href="/productPage">
                        <div class="card card-plain h-100 bg-white">
                            <div class="p-3">
                                <div class="row">
                                    <div class="col-9 col-lg-8 col-md-8 col-sm-9">
                                        <div>
                                            <h3 id="total-product" class="mb-0 text-capitalize font-weight-bold">00</h3>
                                            <p class="mb-0 text-lg">Product</p>
                                        </div>
                                    </div>
                                    <div class="col-3 col-lg-4 col-md-4 col-sm-3 text-end">
                                        <div class="icon icon-shape bg-gradient-primary shadow float-end border-radius-md">
                                            <img class="w-100" src="{{asset('images/icon.svg')}}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
        
                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 animated fadeIn p-2">
                    <a href="/categoryPage">
                        <div class="card card-plain h-100 bg-white">
                            <div class="p-3">
                                <div class="row">
                                    <div class="col-9 col-lg-8 col-md-8 col-sm-9">
                                        <div>
                                            <h3 id="total-category" class="mb-0 text-capitalize font-weight-bold">00</h3>
                                            <p class="mb-0 text-lg">Category</p>
                                        </div>
                                    </div>
                                    <div class="col-3 col-lg-4 col-md-4 col-sm-3 text-end">
                                        <div class="icon icon-shape bg-gradient-primary shadow float-end border-radius-md">
                                            <img class="w-100" src="{{asset('images/icon.svg')}}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
        
                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 animated fadeIn p-2">
                    <a href="/customerPage">
                        <div class="card card-plain h-100 bg-white">
                            <div class="p-3">
                                <div class="row">
                                    <div class="col-9 col-lg-8 col-md-8 col-sm-9">
                                        <div>
                                            <h3 id="total-customer" class="mb-0 text-capitalize font-weight-bold">00</h3>
                                            <p class="mb-0 text-lg">Customer</p>
                                        </div>
                                    </div>
                                    <div class="col-3 col-lg-4 col-md-4 col-sm-3 text-end">
                                        <div class="icon icon-shape bg-gradient-primary shadow float-end border-radius-md">
                                            <img class="w-100" src="{{asset('images/icon.svg')}}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
        
                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 animated fadeIn p-2">
                    <a href="your-sales-page-url">
                        <div class="card card-plain h-100 animated fadeIn bg-white">
                            <div class="p-3">
                                <div class="row">
                                    <div class="col-9 col-lg-8 col-md-8 col-sm-9">
                                        <div>
                                            <h3 class="mb-0 text-capitalize font-weight-bold">00</h3>
                                            <p class="mb-0 text-lg">Sales</p>
                                        </div>
                                    </div>
                                    <div class="col-3 col-lg-4 col-md-4 col-sm-3 text-end">
                                        <div class="icon icon-shape bg-gradient-primary shadow float-end border-radius-md">
                                            <img class="w-100" src="{{asset('images/icon.svg')}}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        


 

<script>
     async function fetchDataAndUpdate(elementId, endpoint) {
        showLoader();
        try {
            let res = await axios.get(endpoint);
            document.getElementById(elementId).innerText = res.data;
        } catch (error) {
            console.error("Error fetching data:", error);
        }
        hideLoader();
    }

    // Call the functions to fetch and update data for each element
    TotalCategory();
    TotalProduct();
    TotalCustomer();

    function TotalCategory() {
        fetchDataAndUpdate("total-category", "/total-category");
    }

    function TotalProduct() {
        fetchDataAndUpdate("total-product", "/total-product");
    }

    function TotalCustomer() {
        fetchDataAndUpdate("total-customer", "/total-customer");
    }


    // TotalCategory();
    // async function TotalCategory() {
    //     showLoader();
    //     let res = await axios.get('/total-category');
    //   //  hideLoader();
    //    document.getElementById("total-category").innerText = res.data;
    //     }


    //     TotalProduct();
    //     async function  TotalProduct() {
    //    // showLoader();
    //     let res = await axios.get('/total-product');
    //   // hideLoader();
    //    document.getElementById("total-product").innerText = res.data;
    //     }

    //     TotalCustomer();
    //     async function TotalCustomer(){
    //    // showLoader();
    //     let res = await axios.get('/total-customer');
    //     hideLoader();
    //    document.getElementById("total-customer").innerText = res.data;
    //     }

</script>