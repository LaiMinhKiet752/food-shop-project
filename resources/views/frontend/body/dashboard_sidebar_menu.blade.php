@php
    $route = Route::current()->getName();
@endphp
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="col-md-2">
    <div class="dashboard-menu">
        <ul class="nav flex-column" role="tablist">
            <li class="nav-item">
                <a class="nav-link {{ $route == 'dashboard' ? 'active' : '' }}" href="{{ route('dashboard') }}"><i
                        class="fi-rs-settings-sliders mr-5"></i>Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $route == 'user.order.page' ? 'active' : '' }}"
                    href="{{ route('user.order.page') }}"><i class="fa-solid fa-cart-shopping mr-5"></i>Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $route == 'cancel.order.page' ? 'active' : '' }}"
                    href="{{ route('cancel.order.page') }}"><i class="fa-solid fa-rectangle-xmark mr-5"></i>Cancel
                    Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $route == 'return.order.page' ? 'active' : '' }}"
                    href="{{ route('return.order.page') }}"><i class="fa-solid fa-arrow-rotate-left mr-5"></i>Return
                    Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fi-rs-shopping-cart-check mr-5"></i>Track Your
                    Order</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fi-rs-marker mr-5"></i>My Address</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $route == 'user.account.page' ? 'active' : '' }}"
                    href="{{ route('user.account.page') }}"><i class="fi-rs-user mr-5"></i>Account
                    Details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $route == 'user.change.password' ? 'active' : '' }}"
                    href="{{ route('user.change.password') }}"><i class="fa-solid fa-code-compare mr-5"></i>Change
                    Password</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.logout') }}"><i class="fi-rs-sign-out mr-5"></i>Logout</a>
            </li>
        </ul>
    </div>
</div>
