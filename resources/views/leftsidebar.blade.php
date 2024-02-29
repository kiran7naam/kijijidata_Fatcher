<aside class="left-sidebar">
    <div class="d-flex no-block nav-text-box align-items-center">
        <span><img src="../assets/images/logo-icon.png" alt="elegant admin template"></span>
        <a class="waves-effect waves-dark ml-auto hidden-sm-down" href="javascript:void(0)"><i class="ti-menu"></i></a>
        <a class="nav-toggler waves-effect waves-dark ml-auto hidden-sm-up" href="javascript:void(0)"><i
                class="ti-menu ti-close"></i></a>
    </div>
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li> <a class="waves-effect waves-dark" href="{{URL::to('home')}}" aria-expanded="false"><i
                            class="fa fa-tachometer"></i><span class="hide-menu">Dashboard</span></a></li>
                <li> <a class="waves-effect waves-dark" href="{{URL::to('product-fetch')}}" aria-expanded="false"><i
                            class="fa fa-product-hunt"></i><span class="hide-menu">Fetch Products from Kijiji</span></a>
                </li>
                <li> <a class="waves-effect waves-dark" href="{{URL::to('view-products')}}" aria-expanded="false"><i
                            class="fa fa-list-alt"></i><span class="hide-menu"></span>View Products</a></li>
                <li> <a class="waves-effect waves-dark" href="{{URL::to('contacted-products')}}"
                        aria-expanded="false"><i class="fa fa-solid fa fa-group"></i><span
                            class="hide-menu"></span>Contacted Products
                        List</a></li>
                <li> <a class="waves-effect waves-dark" href="{{URL::to('deleted-products')}}" aria-expanded="false"><i
                            class="fa fa-solid fa fa-trash fa-lg"></i><span class="hide-menu"></span>Deleted Products
                        List</a></li>
                <li> <a class="waves-effect waves-dark" href="{{route('user-profile', ['id' => Auth::user()->id])}}"
                        aria-expanded="false"><i class="fa fa-solid fa fa-user fa-lg"></i><span
                            class="hide-menu"></span>User Profile</a></li>
                <li> <a class="waves-effect waves-dark" href="{{URL::to('view-users')}}" aria-expanded="false"><i
                            class="fa fa-solid fa fa-user-plus fa-lg"></i><span class="hide-menu"></span>View and Add
                        User</a></li>

            </ul>
        </nav>
    </div>
</aside>