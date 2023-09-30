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
                                    <img class="w-100" src="{{ asset('images/icon.svg') }}" />
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
                                    <img class="w-100" src="{{ asset('images/icon.svg') }}" />
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
                                    <img class="w-100" src="{{ asset('images/icon.svg') }}" />
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
                                    <h3 id="total-sale" class="mb-0 text-capitalize font-weight-bold">00</h3>
                                    <p class="mb-0 text-lg">Sales</p>
                                </div>
                            </div>
                            <div class="col-3 col-lg-4 col-md-4 col-sm-3 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow float-end border-radius-md">
                                    <img class="w-100" src="{{ asset('images/icon.svg') }}" />
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
    const getStatistics = async () => {
        showLoader();
        try {
            const totalProduct = await axios.get('/total-product');
            const totalCategory = await axios.get('/total-category');
            const totalCustomer = await axios.get('/total-customer');
            const totalSale = await axios.get('/total-sale');
            hideLoader();

            DOM('total-customer', totalCustomer);
            DOM('total-product', totalProduct);
            DOM('total-category', totalCategory);
            DOM('total-sale', totalSale);

        } catch (error) {
            hideLoader();
            errorToast('Stastics loading failed')
        }

    }
    getStatistics();

    const DOM = (elementId, data) => {
        const element = document.getElementById(elementId);
      element.innerText = data['data']
    }
</script>
