<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('adminbackend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Admin</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">

        <li>
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>


        @if (Auth::user()->can('brand.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-cookie'></i>
                    </div>
                    <div class="menu-title">Brand</div>
                </a>
                <ul>
                    @if (Auth::user()->can('brand.list'))
                        <li> <a href="{{ route('all.brand') }}"><i class="bx bx-right-arrow-alt"></i>All Brand</a>
                        </li>
                    @endif

                    @if (Auth::user()->can('brand.restore'))
                        <li> <a href="{{ route('restore.brand') }}"><i class="bx bx-right-arrow-alt"></i>Restore
                                Brand</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (Auth::user()->can('category.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-category"></i>
                    </div>
                    <div class="menu-title">Category</div>
                </a>
                <ul>
                    @if (Auth::user()->can('category.list'))
                        <li> <a href="{{ route('all.category') }}"><i class="bx bx-right-arrow-alt"></i>All Category</a>
                        </li>
                    @endif

                    @if (Auth::user()->can('category.restore'))
                        <li> <a href="{{ route('restore.category') }}"><i class="bx bx-right-arrow-alt"></i>Restore
                                Category</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (Auth::user()->can('subcategory.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-codepen"></i>
                    </div>
                    <div class="menu-title">SubCategory</div>
                </a>
                <ul>
                    @if (Auth::user()->can('subcategory.list'))
                        <li> <a href="{{ route('all.subcategory') }}"><i class="bx bx-right-arrow-alt"></i>All
                                SubCategory</a>
                        </li>
                    @endif

                    @if (Auth::user()->can('subcategory.restore'))
                        <li> <a href="{{ route('restore.subcategory') }}"><i class="bx bx-right-arrow-alt"></i>Restore
                                SubCategory</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (Auth::user()->can('product.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-fresh-juice"></i>
                    </div>
                    <div class="menu-title">Product</div>
                </a>
                <ul>
                    @if (Auth::user()->can('product.list'))
                        <li> <a href="{{ route('all.product') }}"><i class="bx bx-right-arrow-alt"></i>All Product</a>
                        </li>
                    @endif

                    @if (Auth::user()->can('product.restore'))
                        <li> <a href="{{ route('restore.product') }}"><i class="bx bx-right-arrow-alt"></i>Restore
                                Product</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (Auth::user()->can('inventory.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-archive"></i>
                    </div>
                    <div class="menu-title">Inventory</div>
                </a>
                <ul>
                    <li> <a href="{{ route('product.stock') }}"><i class="bx bx-right-arrow-alt"></i>Product Stock</a>
                    </li>
                </ul>
            </li>
        @endif

        @if (Auth::user()->can('slider.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-gallery"></i>
                    </div>
                    <div class="menu-title">Slider</div>
                </a>
                <ul>
                    @if (Auth::user()->can('slider.list'))
                        <li> <a href="{{ route('all.slider') }}"><i class="bx bx-right-arrow-alt"></i>All Slider</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (Auth::user()->can('banner.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-image"></i>
                    </div>
                    <div class="menu-title">Banner</div>
                </a>
                <ul>
                    @if (Auth::user()->can('banner.list'))
                        <li> <a href="{{ route('all.banner') }}"><i class="bx bx-right-arrow-alt"></i>All Banner</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (Auth::user()->can('coupon.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-invention"></i>
                    </div>
                    <div class="menu-title">Coupon</div>
                </a>
                <ul>
                    @if (Auth::user()->can('coupon.list'))
                        <li> <a href="{{ route('all.coupon') }}"><i class="bx bx-right-arrow-alt"></i>All Coupon</a>
                        </li>
                    @endif

                    @if (Auth::user()->can('coupon.restore'))
                        <li> <a href="{{ route('restore.coupon') }}"><i class="bx bx-right-arrow-alt"></i>Restore
                                Coupon</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (Auth::user()->can('shipping.area.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-map"></i>
                    </div>
                    <div class="menu-title">Shipping Area</div>
                </a>
                <ul>
                    <li> <a href="{{ route('all.city') }}"><i class="bx bx-right-arrow-alt"></i>All Cities,
                            Provinces</a>
                    </li>
                    <li> <a href="{{ route('all.district') }}"><i class="bx bx-right-arrow-alt"></i>All Districts</a>
                    </li>
                    <li> <a href="{{ route('all.commune') }}"><i class="bx bx-right-arrow-alt"></i>All Communes</a>
                    </li>
                </ul>
            </li>
        @endif


        <li class="menu-label" style="color: black; font-weight: bold;">Order Management</li>
        @if (Auth::user()->can('order.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-cart'></i>
                    </div>
                    <div class="menu-title">All Orders</div>
                </a>
                <ul>
                    <li> <a href="{{ route('pending.order') }}"><i class="bx bx-right-arrow-alt"></i>Pending
                            Order</a>
                    </li>
                    <li> <a href="{{ route('admin.confirmed.order') }}"><i
                                class="bx bx-right-arrow-alt"></i>Confirmed
                            Order</a>
                    </li>
                    <li> <a href="{{ route('admin.processing.order') }}"><i
                                class="bx bx-right-arrow-alt"></i>Processing
                            Order</a>
                    </li>
                    <li> <a href="{{ route('admin.delivered.order') }}"><i
                                class="bx bx-right-arrow-alt"></i>Delivered
                            Order</a>
                    </li>
                </ul>
            </li>
        @endif

        @if (Auth::user()->can('return.order.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='lni lni-spinner-arrow'></i>
                    </div>
                    <div class="menu-title">Return Order</div>
                </a>
                <ul>
                    <li> <a href="{{ route('admin.return.request') }}"><i class="bx bx-right-arrow-alt"></i>Return
                            Request</a>
                    </li>
                    <li> <a href="{{ route('admin.complete.return.request') }}"><i
                                class="bx bx-right-arrow-alt"></i>Approved Return Request</a>
                </ul>
            </li>
        @endif

        @if (Auth::user()->can('cancel.order.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='lni lni-cross-circle'></i>
                    </div>
                    <div class="menu-title">Cancel Order</div>
                </a>
                <ul>
                    <li> <a href="{{ route('admin.cancel.request') }}"><i class="bx bx-right-arrow-alt"></i>Cancel
                            Request</a>
                    </li>
                    <li> <a href="{{ route('admin.complete.cancel.request') }}"><i
                                class="bx bx-right-arrow-alt"></i>Approved Cancel Request</a>
                </ul>
            </li>
        @endif

        @if (Auth::user()->can('report.order.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='lni lni-stats-up'></i>
                    </div>
                    <div class="menu-title">Report</div>
                </a>
                <ul>
                    <li> <a href="{{ route('report.view') }}"><i class="bx bx-right-arrow-alt"></i>Report By Day,
                            Month,
                            Year</a>
                    </li>
                    <li> <a href="{{ route('report.by.customer') }}"><i class="bx bx-right-arrow-alt"></i>Report By
                            Customer</a>
                    </li>
                </ul>
            </li>
        @endif


        <li class="menu-label" style="color: black; font-weight: bold;">Website Management</li>
        @if (Auth::user()->can('blog.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-support"></i>
                    </div>
                    <div class="menu-title">Blog</div>
                </a>
                <ul>
                    <li> <a href="{{ route('admin.blog.category') }}"><i class="bx bx-right-arrow-alt"></i>Blog
                            Category</a>
                    </li>
                    <li> <a href="{{ route('admin.blog.post') }}"><i class="bx bx-right-arrow-alt"></i>Blog Post</a>
                    </li>
                    <li> <a href="{{ route('admin.blog.comment') }}"><i class="bx bx-right-arrow-alt"></i>Blog
                            Comment</a>
                    </li>
                </ul>
            </li>
        @endif


        @if (Auth::user()->can('contact.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-telegram-original"></i>
                    </div>
                    <div class="menu-title">Contact</div>
                </a>
                <ul>
                    <li> <a href="{{ route('admin.contact.message') }}"><i class="bx bx-right-arrow-alt"></i>Contact
                            Messages @if ($unReadMessage > 0)
                                <span class="badge rounded-pill bg-danger"
                                    style="margin-left: 10px;">{{ $unReadMessage }}</span>
                            @else
                            @endif
                        </a></li>
                </ul>
            </li>
        @endif

        @if (Auth::user()->can('review.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-star"></i>
                    </div>
                    <div class="menu-title">Review</div>
                </a>
                <ul>
                    <li> <a href="{{ route('admin.pending.review') }}"><i class="bx bx-right-arrow-alt"></i>Pending
                            Review</a>
                    </li>
                    <li> <a href="{{ route('admin.publish.review') }}"><i class="bx bx-right-arrow-alt"></i>Publish
                            Review</a>
                    </li>
                </ul>
            </li>
        @endif


        @if (Auth::user()->can('subscriber.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-emoji-happy"></i>
                    </div>
                    <div class="menu-title">Subscribers</div>
                </a>
                <ul>
                    <li> <a href="{{ route('admin_subscribers') }}"><i class="bx bx-right-arrow-alt"></i>All
                            Subscribers</a>
                    </li>
                    <li> <a href="{{ route('admin_subscribers_send_email') }}"><i
                                class="bx bx-right-arrow-alt"></i>Send
                            Mail To All Subscribers</a>
                    </li>
                </ul>
            </li>
        @endif


        @if (Auth::user()->can('setting.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-cog"></i>
                    </div>
                    <div class="menu-title">Setting</div>
                </a>
                <ul>
                    <li> <a href="{{ route('admin.site.setting') }}"><i class="bx bx-right-arrow-alt"></i>Site
                            Setting</a>
                    </li>
                    <li> <a href="{{ route('admin.smtp.setting') }}"><i class="bx bx-right-arrow-alt"></i>SMTP
                            Setting</a>
                    </li>
                    <li> <a href="{{ route('admin.seo.setting') }}"><i class="bx bx-right-arrow-alt"></i>Seo
                            Setting</a>
                    </li>
                </ul>
            </li>
        @endif

        <li class="menu-label" style="color: black; font-weight: bold;">Roles and Permissions</li>
        @if (Auth::user()->can('roles.permissions.menu'))
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="lni lni-users"></i>
                    </div>
                    <div class="menu-title">Roles & Permissions</div>
                </a>
                <ul>
                    <li> <a href="{{ route('all.permission') }}"><i class="bx bx-right-arrow-alt"></i>All
                            Permissions</a>
                    </li>
                    <li> <a href="{{ route('all.role') }}"><i class="bx bx-right-arrow-alt"></i>All Roles</a>
                    </li>
                    <li> <a href="{{ route('add.role.permissions') }}"><i class="bx bx-right-arrow-alt"></i>Add
                            Permissions For Roles</a>
                    </li>
                    <li> <a href="{{ route('all.role.permissions') }}"><i class="bx bx-right-arrow-alt"></i>All Role
                            Has
                            Permissions</a>
                    </li>
                </ul>
            </li>
        @endif

        @if (Auth::user()->can('admin.user.account.menu'))
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="lni lni-user"></i>
                    </div>
                    <div class="menu-title">Admin User Account</div>
                </a>
                <ul>
                    <li> <a href="{{ route('all.admin.account') }}"><i class="bx bx-right-arrow-alt"></i>All Admin
                            User Accounts</a>
                    </li>
                </ul>
            </li>
        @endif

        <li class="menu-label" style="color: black; font-weight: bold;">Vendor And User Management</li>
        @if (Auth::user()->can('vendor.management.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bxs-group'></i>
                    </div>
                    <div class="menu-title">Vendor</div>
                </a>
                <ul>
                    <li> <a href="{{ route('active.vendor') }}"><i class="bx bx-right-arrow-alt"></i>Active
                            Vendor</a>
                    </li>
                    <li> <a href="{{ route('inactive.vendor') }}"><i class="bx bx-right-arrow-alt"></i>InActive
                            Vendor</a>
                    </li>
                </ul>
            </li>
        @endif

        @if (Auth::user()->can('user.management.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='lni lni-slideshare'></i>
                    </div>
                    <div class="menu-title">User</div>
                </a>
                <ul>
                    <li> <a href="{{ route('all.user') }}"><i class="bx bx-right-arrow-alt"></i>All Customers</a>
                    </li>
                    <li> <a href="{{ route('all.vendor') }}"><i class="bx bx-right-arrow-alt"></i>All Vendors</a>
                    </li>
                </ul>
            </li>
        @endif

        <li class="menu-label" style="color: black; font-weight: bold;">Employee Management</li>
        @if (Auth::user()->can('employee.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='lni lni-network'></i>
                    </div>
                    <div class="menu-title">Employees</div>
                </a>
                <ul>
                    @if (Auth::user()->can('employee.list'))
                        <li> <a href="{{ route('all.employee') }}"><i class="bx bx-right-arrow-alt"></i>All
                                Employees</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif


        @if (Auth::user()->can('employee.salary.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='lni lni-coin'></i>
                    </div>
                    <div class="menu-title">Employees Salary</div>
                </a>
                <ul>
                    @if (Auth::user()->can('employee.salary.list'))
                        <li> <a href="{{ route('all.advance.salary') }}"><i class="bx bx-right-arrow-alt"></i>All
                                Employees Advance Salary</a>
                        </li>
                    @endif

                    @if (Auth::user()->can('employee.pay.salary'))
                        <li> <a href="{{ route('pay.salary') }}"><i class="bx bx-right-arrow-alt"></i>Pay Salary</a>
                        </li>
                    @endif

                    @if (Auth::user()->can('employee.search.pay.salary.by.month'))
                        <li> <a href="{{ route('month.salary') }}"><i class="bx bx-right-arrow-alt"></i>Search Pay
                                Salary By Month</a>
                        </li>
                    @endif

                </ul>
            </li>
        @endif


        @if (Auth::user()->can('timekeeping.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='lni lni-save'></i>
                    </div>
                    <div class="menu-title">Timekeeping</div>
                </a>
                <ul>
                    @if (Auth::user()->can('timekeeping.by.day'))
                        <li> <a href="{{ route('employee.attendance.list') }}"><i
                                    class="bx bx-right-arrow-alt"></i>Timekeeping By Day</a>
                        </li>
                    @endif

                    @if (Auth::user()->can('timekeeping.by.day'))
                        <li> <a href="{{ route('timekeeping.by.month') }}"><i
                                    class="bx bx-right-arrow-alt"></i>Timekeeping
                                By Month</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif


        <li class="menu-label" style="color: black; font-weight: bold;">Database backup For System</li>
        @if (Auth::user()->can('database.backup'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='lni lni-cloud-sync'></i>
                    </div>
                    <div class="menu-title">Database Backup</div>
                </a>
                <ul>
                    <li> <a href="{{ route('database.backup') }}"><i class="bx bx-right-arrow-alt"></i>Database
                            Backup</a>
                    </li>
                </ul>
            </li>
        @endif

        <li>
            <a href="#" target="_blank">
                <div class="parent-icon"><i class="bx bx-support"></i>
                </div>
                <div class="menu-title">Support</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
