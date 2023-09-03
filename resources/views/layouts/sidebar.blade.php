<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      	<img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      	<span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    	<!-- Sidebar user panel (optional) -->
	    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
	        <div class="image">
	          <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
	        </div>
	        <div class="info">
	          <a href="#" class="d-block">Alexander Pierce</a>
	        </div>
	    </div>

	    <!-- Sidebar Menu -->
	    <nav class="mt-2">
	        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
	          	<li class="nav-item">
		            <a href="/dashboard" class="nav-link{{ Request::is('dashboard') ? ' active' : '' }}">
			            <i class="nav-icon fas fa-tachometer-alt"></i>
			            <p>Dashboard</p>
		            </a>
	          	</li>
	          	<li class="nav-item">
		            <a href="pages/widgets.html" class="nav-link">
			            <i class="nav-icon fas fa-th"></i>
			            <p>
			                Widgets
			                <span class="right badge badge-danger">New</span>
			            </p>
		            </a>
	          	</li>
	          	<li class="nav-item{{ Request::is('bank', 'supplier', 'customer') ? ' menu-is-opening menu-open' : '' }}">
		            <a href="" class="nav-link{{ Request::is('bank', 'supplier', 'customer') ? ' active' : '' }}">
		              	<i class="nav-icon fas fa-copy"></i>
		              	<p>Data Master<i class="fas fa-angle-left right"></i></p>
		            </a>
		            <ul class="nav nav-treeview">
		              	<li class="nav-item">
		              		<a href="/bank" class="nav-link{{ Request::is('bank') ? ' active' : '' }}">
			                  	<i class="far fa-circle nav-icon"></i>
			                  	<p>Akun Bank</p>
			                </a>
			                <a href="/supplier" class="nav-link{{ Request::is('supplier') ? ' active' : '' }}">
			                  	<i class="far fa-circle nav-icon"></i>
			                  	<p>Supplier</p>
			                </a>
			                <a href="/customer" class="nav-link{{ Request::is('customer') ? ' active' : '' }}">
			                  	<i class="far fa-circle nav-icon"></i>
			                  	<p>Customer</p>
			                </a>
			            </li>
			        </ul>
		        </li>
	          	<li class="nav-item{{ Request::is('category', 'product_group', 'size', 'color', 'unit', 'product') ? ' menu-is-opening menu-open' : '' }}">
		            <a href="" class="nav-link{{ Request::is('category', 'product_group', 'size', 'color', 'unit', 'product') ? ' active' : '' }}">
		              	<i class="nav-icon fas fa-copy"></i>
		              	<p>Produk<i class="fas fa-angle-left right"></i></p>
		            </a>
		            <ul class="nav nav-treeview">
		              	<li class="nav-item">
		              		<a href="/category" class="nav-link{{ Request::is('category') ? ' active' : '' }}">
			                  	<i class="far fa-circle nav-icon"></i>
			                  	<p>Kategori</p>
			                </a>
			                <a href="/product_group" class="nav-link{{ Request::is('product_group') ? ' active' : '' }}">
			                  	<i class="far fa-circle nav-icon"></i>
			                  	<p>Kelompok Produk</p>
			                </a>
			                <a href="/size" class="nav-link{{ Request::is('size') ? ' active' : '' }}">
			                  	<i class="far fa-circle nav-icon"></i>
			                  	<p>Ukuran</p>
			                </a>
			                <a href="/color" class="nav-link{{ Request::is('color') ? ' active' : '' }}">
			                  	<i class="far fa-circle nav-icon"></i>
			                  	<p>Warna</p>
			                </a>
			                <a href="/unit" class="nav-link{{ Request::is('unit') ? ' active' : '' }}">
			                  	<i class="far fa-circle nav-icon"></i>
			                  	<p>Satuan</p>
			                </a>
		              		<a href="/product" class="nav-link{{ Request::is('product') ? ' active' : '' }}">
			                  	<i class="far fa-circle nav-icon"></i>
			                  	<p>Produk</p>
			                </a>
		              	</li>
		            </ul>
	          	</li>
	          	<li class="nav-item">
		            <a href="/purchase" class="nav-link">
			            <i class="nav-icon fas fa-list"></i>
			            <p>Pembelian</p>
		            </a>
	          	</li>
	          	<li class="nav-header">HALAMAN WEB</li>
	          	<li class="nav-item">
		            <a href="/admin/page/tentang-kami" class="nav-link">
		              	<i class="far fa-circle nav-icon"></i>
		              	<p>Tentang Kami</p>
		            </a>
		        </li>
		        <li class="nav-item">
		            <a href="/admin/page/syarat-dan-ketentuan" class="nav-link">
		              	<i class="far fa-circle nav-icon"></i>
		              	<p>Syarat Dan Ketentuan</p>
		            </a>
		        </li>
		        <li class="nav-item">
		            <a href="/admin/page/kebijakan-privasi" class="nav-link">
		              	<i class="far fa-circle nav-icon"></i>
		              	<p>Kebijakan Privasi</p>
		            </a>
		        </li>
		        <li class="nav-item">
		            <a href="/admin/page/lokasi-toko" class="nav-link">
		              	<i class="far fa-circle nav-icon"></i>
		              	<p>Lokasi Toko</p>
		            </a>
		        </li>
	          	<li class="nav-item">
		            <a href="/logout" class="nav-link">
		              	<i class="nav-icon fas fa-sign-out-alt"></i>
		              	<p>Logout</p>
		            </a>
		        </li>
	       	</ul>
	    </nav>
	</div>
</aside>