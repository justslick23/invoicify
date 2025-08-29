<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <!-- Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center mb-3" href="{{ route('home') }}">
            <img src="{{ asset('/images/logoo.png') }}" width="160" alt="Logo">
        </a>

        <!-- Navigation -->
        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Main
            </li>

            <li class="sidebar-item {{ request()->routeIs('home') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('home') }}">
                    <i class="align-middle ti ti-layout-dashboard"></i> 
                    <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-header">
                Management
            </li>

            <li class="sidebar-item {{ request()->routeIs('clients.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('clients.index') }}">
                    <i class="align-middle ti ti-user"></i> 
                    <span class="align-middle">Clients</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('products.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('products.index') }}">
                    <i class="align-middle ti ti-package"></i> 
                    <span class="align-middle">Products</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('quotes.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('quotes.index') }}">
                    <i class="align-middle ti ti-file"></i> 
                    <span class="align-middle">Quotes</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('invoices.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('invoices.index') }}">
                    <i class="align-middle ti ti-receipt"></i> 
                    <span class="align-middle">Invoices</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('payments.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('payments.index') }}">
                    <i class="align-middle ti ti-credit-card"></i> 
                    <span class="align-middle">Payments</span>
                </a>
            </li>

         
        </ul>

    </div>
</nav>
