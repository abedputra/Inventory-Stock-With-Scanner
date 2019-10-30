<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('user.png') }} " class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ \Auth::user()->name  }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
            </div>
        </form> -->
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">HEADER</li>
            <!-- Optionally, you can add icons to the links -->
            <li class=""><a href="{{ url('/home') }}"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>
            <li class=""><a href="{{ route('categories.index') }}"><i class="fa fa-folder-o"></i> <span>Category</span></a></li>
            <li class=""><a href="{{ route('products.index') }}"><i class="fa fa-product-hunt"></i> <span>Product</span></a></li>
            <li class=""><a href="{{ route('productsIn.index') }}"><i class="fa fa-sign-in"></i> <span>Product In</span></a></li>
            <li class=""><a href="{{ route('productsOut.index') }}"><i class="fa fa-sign-out"></i> <span>Product Out</span></a></li>
            <li class=""><a href="{{ route('customers.index') }}"><i class="fa fa-user"></i> <span>Customer</span></a></li>
            <li class=""><a href="{{ route('sales.index') }}"><i class="fa fa-users"></i> <span>Sales</span></a></li>
            <li class=""><a href="{{ route('suppliers.index') }}"><i class="fa fa-building-o"></i> <span>Supplier</span></a></li>
            @if (Auth::user()->role == "admin" )
                <li class=""><a href="{{ route('company.index') }}"><i class="fa fa-building"></i> <span>Company Details</span></a></li>
                <li class=""><a href="{{ route('users.index') }}"><i class="fa fa-user-o"></i> <span>Users</span></a></li>
            @endif
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
