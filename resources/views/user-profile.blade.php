<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Profile</title>
    @include('header');
</head>

<body class="skin-default-dark fixed-layout">
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Elegant admin</p>
        </div>
    </div>
    <div id="main-wrapper">
        @include('topbar');
        @include('leftsidebar');
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Profile</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-body">
                            @if(Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('success') }}
                            </div>
                            @endif
                                <form action="{{ route('update_profile', ['id' => $user_data->id]) }}" method="POST" class="form-horizontal form-material">
                                @csrf    
                                <div class="form-group">
                                        <label class="col-md-12">Full Name</label>
                                        <div class="col-md-12">
                                            <input type="text" name="user_name" placeholder="Johnathan Doe"
                                                class="form-control form-control-line" value="{{$user_data->name}}">
                                                <input type="hidden" name="user_id" placeholder="Johnathan Doe"
                                                class="form-control form-control-line" value="{{$user_data->id}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Email</label>
                                        <div class="col-md-12">
                                            <input type="email" placeholder="johnathan@admin.com"
                                                class="form-control form-control-line" name="user_email"
                                                id="user_email"  value="{{$user_data->email}}">
                                        </div>
                                    </div> 
                                    <div class="form-group">                                        
                                        <div class="col-md-12">
                                            <input type="checkbox" id="change_password" value="1" name="change_password"><label
                                                class="check-label">Change Password</label>
                                        </div>
                                    </div>
                                    <div class="form-group password_section" style="display:none;">
                                        <label class="col-md-12">Password</label>
                                        <div class="col-md-12">
                                            <input type="password" name="user_password" value=""
                                                class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success" type="submit">Update Profile</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            © 2020 Elegent Admin by <a href="https://www.wrappixel.com/">wrappixel.com</a>
        </footer>
    </div>
    @include('footer-scripts')
</body>

</html>