<!DOCTYPE html>
<html lang="en">

<head>
    <title>Contacted Products List</title>
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
                        <h4 class="text-themecolor">Contacted Products</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">View Deleted Products</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <form action="{{route('contacted_products')}}" method="GET">
                                <div class="row ma-2">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-md-12">Category</label>
                                            <input type="text" placeholder="By Category" id="category" name="category"
                                                class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-md-12">Price</label>
                                            <div class="row">
                                                <select class="col-md-6 form-control form-control-line" name="price_type">
                                                    <option value="1">Equals to(=)</option>
                                                    <option value="2">Greater than(>)</option>
                                                    <option value="3">Less than(<)</option>
                                                    <option value="4">Greater than equal to(>=)</option>
                                                    <option value="5">Less than equal to(<=)</option>
                                                </select>
                                                <input type="text" placeholder="By Price" id="price" name="price"
                                                    class="col-md-6 form-control form-control-line">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-md-12">&nbsp;</label>
                                            <button type="submit" class="btn btn-success"
                                                id="search_data">Search</button>
                                            <button type="button" class="btn btn-primary" id="reset_data">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="table-responsive">
                                @include('products/contacted-products-data')
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
            </div>
        </div>
        <!-- modal start -->
        <!-- The Modal -->
        <div id="myProductDetailsModal" class="modal">
            <div class="modal-dialog">
                <!-- Modal content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Product Details</h2>
                        <span class="close close_productdetails_popup">&times;</span>
                    </div>
                    <div class="modal-body">
                        <div class="productDetailsBody">
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal -->
        <footer class="footer">
            © 2023
        </footer>
    </div>
    @include('footer-scripts')
    <script src="/modulejs/product.js"></script>
</body>

</html>