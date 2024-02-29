<!DOCTYPE html>
<html lang="en">

<head>
    <title>Deleted Products List</title>
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
                        <h4 class="text-themecolor">Deleted Products List</h4>
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
                        <!-- <div class="card"> -->
                            <form>
                                <div class="row ma-2">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-danger" id="delete_all_products">Delete
                                                all selected Products</button>
                                            <button type="button" class="btn btn-primary" id="reset_data">Reset</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    </div>
                                    <div class="col-md-3 rightAlign">
                                            <button type="button" class="btn btn-danger" id="trash_data" onclick="permanent_delete_product('',1);">Empty Trash
                                                List</button>
                                    </div>
                                </div>
                            </form>
                        <!-- </div> -->
                    </div>
                    <!-- Column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="table-responsive">
                                @include('products/deleted-products-data')
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