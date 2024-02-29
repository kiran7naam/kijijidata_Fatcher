<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard</title>
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
                        <h4 class="text-themecolor">Dashboard</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <br />
                <br />
                <div class="row">
                    <div class="col-md-4 col-centered">
                        <a class="" href="{{URL::to('product-fetch')}}" aria-expanded="false">
                            <div class="section-content">
                                <i class="fa fa-product-hunt fa-5x"></i><br />
                                Fetch Products from KIJIJI
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-centered">
                        <a class="" href="{{URL::to('view-products')}}" aria-expanded="false">
                            <div class="section-content">
                                <i class="fa fa-list-alt fa-5x"></i><br>View Products
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-centered">
                        <a class="" href="{{URL::to('contacted-products')}}" aria-expanded="false">
                            <div class="section-content">
                                <i class="fa fa-group fa-5x"></i><br>View Contacted Products
                            </div>
                        </a>
                    </div>
                </div>
                <br />
                <br />
                <br />
                <br />
                <div class="row">
                    <div class="col-md-4 col-centered">
                        <a class="" href="{{URL::to('deleted-products')}}" aria-expanded="false">
                            <div class="section-content">
                                <i class="fa fa-trash fa-5x"></i><br />
                                VIew Deleted Products
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-centered">
                        <a class="" href="{{route('user-profile', ['id' => Auth::user()->id])}}" aria-expanded="false">
                            <div class="section-content">
                                <i class="fa fa-user fa-5x"></i><br>User Profile
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-centered">
                        <a class="" href="{{URL::to('view-users')}}" aria-expanded="false">
                            <div class="section-content">
                                <i class="fa fa-user-plus fa-5x"></i><br>View and Add User
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            © 2023
        </footer>
    </div>
    @include('footer-scripts');
</body>

</html>