<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="index.html">Admin Panel</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html"></a>
    </div>

    <ul class="sidebar-menu">

     
        <li class="{{Request::is('admin/admin*') ? 'active' : ''}}"><a class="nav-link" href="{{route('admin.admin')}}"><i class="fas fa-hand-point-right"></i> <span>Admin</span></a></li>
        <li class="{{Request::is('admin/user*') ? 'active' : ''}}"><a class="nav-link" href="{{route('admin.user')}}"><i class="fas fa-hand-point-right"></i> <span>User</span></a></li> 

    
<!--
        

        <li class=""><a class="nav-link" href="form.html"><i class="fas fa-hand-point-right"></i> <span>Form</span></a></li>

        <li class=""><a class="nav-link" href="table.html"><i class="fas fa-hand-point-right"></i> <span>Table</span></a></li>

        <li class=""><a class="nav-link" href="invoice.html"><i class="fas fa-hand-point-right"></i> <span>Invoice</span></a></li>-->

    </ul>
</aside>