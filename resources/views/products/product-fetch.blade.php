<!DOCTYPE html>
<html lang="en">

<head>
    <title>Products</title>
    @include('header');
</head>

<body class="skin-default-dark fixed-layout">
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Loading....</p>
        </div>
    </div>
    <div id="main-wrapper">
        @include('topbar');
        @include('leftsidebar');
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Products</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Products</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Tab panes -->
                            <div class="card-body">
                                <div class="d-flex">
                                    <div>
                                        <h5 class="card-title">Fetch Products from Kijiji</h5>
                                    </div>
                                </div>
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-2">Product Name</label>
                                            <div class="col-md-10">
                                                <input type="text" id="search_by_product_name"
                                                    placeholder="Type product name to search"
                                                    class="form-control form-control-line">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success" id="search_products">Search
                                                Products</button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <p class="search_instruction">Enter the desired keyword such as "Atv" into the Kijiji search bar and click the "Search" button. This action will initiate the automatic download of products. Please refrain from closing the browser or engaging in other activities within the browser during this process.</p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
            </div>
        </div>
        <footer class="footer">
            © 2023
        </footer>
    </div>
    @include('footer-scripts')
    <script src="/modulejs/product.js"></script>
</body>

</html>