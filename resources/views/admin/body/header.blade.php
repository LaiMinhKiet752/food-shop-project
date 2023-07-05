<header>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand">
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
            </div>
            <div class="search-bar flex-grow-1">
                <div class="position-relative search-bar-box">
                    <input type="text" class="form-control search-control" placeholder="Type to search..."> <span
                        class="position-absolute top-50 search-show translate-middle-y"><i
                            class='bx bx-search'></i></span>
                    <span class="position-absolute top-50 search-close translate-middle-y"><i
                            class='bx bx-x'></i></span>
                </div>
            </div>
            <div class="top-menu ms-auto">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item mobile-search-icon">
                        <a class="nav-link" href="#"> <i class='bx bx-search'></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown dropdown-large">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false"> <i class='bx bx-category'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <div class="row row-cols-3 g-3 p-3">
                                <div class="col text-center">
                                    <div class="app-box mx-auto bg-gradient-cosmic text-white"><i
                                            class='bx bx-group'></i>
                                    </div>
                                    <div class="app-title">Teams</div>
                                </div>
                                <div class="col text-center">
                                    <div class="app-box mx-auto bg-gradient-burning text-white"><i
                                            class='bx bx-atom'></i>
                                    </div>
                                    <div class="app-title">Projects</div>
                                </div>
                                <div class="col text-center">
                                    <div class="app-box mx-auto bg-gradient-lush text-white"><i
                                            class='bx bx-shield'></i>
                                    </div>
                                    <div class="app-title">Tasks</div>
                                </div>
                                <div class="col text-center">
                                    <div class="app-box mx-auto bg-gradient-kyoto text-dark"><i
                                            class='bx bx-notification'></i>
                                    </div>
                                    <div class="app-title">Feeds</div>
                                </div>
                                <div class="col text-center">
                                    <div class="app-box mx-auto bg-gradient-blues text-dark"><i class='bx bx-file'></i>
                                    </div>
                                    <div class="app-title">Files</div>
                                </div>
                                <div class="col text-center">
                                    <div class="app-box mx-auto bg-gradient-moonlit text-white"><i
                                            class='bx bx-filter-alt'></i>
                                    </div>
                                    <div class="app-title">Alerts</div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @php
                        $count = Auth::user()
                            ->unreadNotifications()
                            ->count();
                        $user = Auth::user();
                    @endphp
                    <li class="nav-item dropdown dropdown-large">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span
                                class="alert-count">{{ $count }}</span>
                            <i class='bx bx-bell'></i>
                            <input type="hidden" name=""
                                value="{{ $user->unreadNotifications()->update(['read_at' => now()]) }}">
                        </a>
                        {{-- Start Notification --}}
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:;">
                                <div class="msg-header">
                                    <p class="msg-header-title">Notifications</p>
                                </div>
                            </a>
                            @php
                                $user = Auth::user();
                            @endphp
                            <div class="header-notifications-list">
                                @forelse ($user->notifications as $notification)
                                    @if ($notification->data['type'] == 'new_order')
                                        <a class="dropdown-item" href="{{ route('pending.order') }}"
                                            id="{{ $notification->id }}" onclick="updateStatusNewOrder(this.id)">
                                            <div
                                                class="d-flex align-items-center {{ $notification->status == 0 ? 'user-online' : '' }}">
                                                <div class="notify bg-light-danger text-danger"><i
                                                        class="bx bx-cart-alt"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="msg-name">New Orders <span
                                                            class="msg-time float-end">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</span>
                                                    </h6>
                                                    <p class="msg-info">{{ $notification->data['message'] }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    @elseif($notification->data['type'] == 'return_order')
                                        <a class="dropdown-item" href="{{ route('admin.return.request') }}"
                                            id="{{ $notification->id }}" onclick="updateStatusReturnOrder(this.id)">
                                            <div
                                                class="d-flex align-items-center {{ $notification->status == 0 ? 'user-online' : '' }}">
                                                <div class="notify bg-light-info text-info"><i
                                                        class="fadeIn animated bx bx-sync"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="msg-name">Request Return Order <span
                                                            class="msg-time float-end">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</span>
                                                    </h6>
                                                    <p class="msg-info">{{ $notification->data['message'] }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    @elseif($notification->data['type'] == 'cancel_order')
                                        <a class="dropdown-item" href="{{ route('admin.cancel.request') }}"
                                            id="{{ $notification->id }}" onclick="updateStatusCancelOrder(this.id)">
                                            <div
                                                class="d-flex align-items-center {{ $notification->status == 0 ? 'user-online' : '' }}">
                                                <div class="notify bg-light-secondary text-secondary"><i
                                                        class="fadeIn animated bx bx-x-circle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="msg-name">Request Cancel Order <span
                                                            class="msg-time float-end">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</span>
                                                    </h6>
                                                    <p class="msg-info">{{ $notification->data['message'] }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    @elseif($notification->data['type'] == 'new_customer')
                                        <a class="dropdown-item" href="{{ route('all.user') }}"
                                            id="{{ $notification->id }}" onclick="updateStatusNewCustomer(this.id)">
                                            <div
                                                class="d-flex align-items-center {{ $notification->status == 0 ? 'user-online' : '' }}">
                                                <div class="notify bg-light-primary text-primary"><i
                                                        class="bx bx-user-pin"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="msg-name">New Customer <span
                                                            class="msg-time float-end">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</span>
                                                    </h6>
                                                    <p class="msg-info">{{ $notification->data['message'] }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    @elseif($notification->data['type'] == 'new_vendor')
                                        <a class="dropdown-item" href="{{ route('inactive.vendor') }}"
                                            id="{{ $notification->id }}" onclick="updateStatusNewVendor(this.id)">
                                            <div
                                                class="d-flex align-items-center {{ $notification->status == 0 ? 'user-online' : '' }}">
                                                <div class="notify bg-light-success text-success"><i
                                                        class="bx bx-group"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="msg-name">New Vendor <span
                                                            class="msg-time float-end">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</span>
                                                    </h6>
                                                    <p class="msg-info">{{ $notification->data['message'] }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    @elseif($notification->data['type'] == 'new_blog_comment')
                                        <a class="dropdown-item" href="{{ route('admin.blog.comment') }}"
                                            id="{{ $notification->id }}" onclick="updateStatusBlogComment(this.id)">
                                            <div
                                                class="d-flex align-items-center {{ $notification->status == 0 ? 'user-online' : '' }}">
                                                <div class="notify bg-light-danger text-danger"><i
                                                        class="bx bx-message-detail"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="msg-name">New Comments <span
                                                            class="msg-time float-end">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</span>
                                                    </h6>
                                                    <p class="msg-info">{{ $notification->data['message'] }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    @elseif($notification->data['type'] == 'new_contact_message')
                                        <a class="dropdown-item" href="{{ route('admin.contact.message') }}"
                                            id="{{ $notification->id }}"
                                            onclick="updateStatusNewContactMessage(this.id)">
                                            <div
                                                class="d-flex align-items-center {{ $notification->status == 0 ? 'user-online' : '' }}">
                                                <div class="notify bg-light-warning text-warning"><i
                                                        class="lni lni-telegram-original"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="msg-name">New Contact Message <span
                                                            class="msg-time float-end">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</span>
                                                    </h6>
                                                    <p class="msg-info">{{ $notification->data['message'] }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    @elseif($notification->data['type'] == 'new_review_product')
                                        <a class="dropdown-item" href="{{ route('admin.pending.review') }}"
                                            id="{{ $notification->id }}"
                                            onclick="updateStatusNewReviewProduct(this.id)">
                                            <div
                                                class="d-flex align-items-center {{ $notification->status == 0 ? 'user-online' : '' }}">
                                                <div class="notify bg-light-info text-info"><i
                                                        class="lni lni-star"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="msg-name">New Review<span
                                                            class="msg-time float-end">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</span>
                                                    </h6>
                                                    <p class="msg-info">{{ $notification->data['message'] }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    @elseif($notification->data['type'] == 'new_subscriber')
                                        <a class="dropdown-item" href="{{ route('admin_subscribers') }}"
                                            id="{{ $notification->id }}"
                                            onclick="updateStatusNewSubscriber(this.id)">
                                            <div
                                                class="d-flex align-items-center {{ $notification->status == 0 ? 'user-online' : '' }}">
                                                <div class="notify bg-light-primary text-primary"><i
                                                        class="lni lni-emoji-happy"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="msg-name">New Subscriber<span
                                                            class="msg-time float-end">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</span>
                                                    </h6>
                                                    <p class="msg-info">{{ $notification->data['message'] }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    @endif
                                @empty
                                    <p class="text-center">There are no new notifications.</p>
                                @endforelse
                            </div>
                            <a href="{{ route('admin.delete.all.notification') }}" id="delete">
                                <div class="text-center msg-footer">Delete All Notifications</div>
                            </a>
                        </div>
                        {{-- End Notification --}}
                    </li>

                    <div style="display: none;">
                        <li class="nav-item dropdown dropdown-large">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative"
                                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span
                                    class="alert-count">8</span>
                                <i class='bx bx-comment'></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="javascript:;">
                                    <div class="msg-header">
                                        <p class="msg-header-title">Messages</p>
                                        <p class="msg-header-clear ms-auto">Marks all as read</p>
                                    </div>
                                </a>
                                <div class="header-message-list">
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="user-online">
                                                <img src="{{ asset('adminbackend/assets/images/avatars/avatar-1.png') }}"
                                                    class="msg-avatar" alt="user avatar">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">Daisy Anderson <span class="msg-time float-end">5
                                                        sec
                                                        ago</span></h6>
                                                <p class="msg-info">The standard chunk of lorem</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="user-online">
                                                <img src="{{ asset('adminbackend/assets/images/avatars/avatar-2.png') }}"
                                                    class="msg-avatar" alt="user avatar">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">Althea Cabardo <span
                                                        class="msg-time float-end">14
                                                        sec ago</span></h6>
                                                <p class="msg-info">Many desktop publishing packages</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="user-online">
                                                <img src="{{ asset('adminbackend/assets/images/avatars/avatar-3.png') }}"
                                                    class="msg-avatar" alt="user avatar">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">Oscar Garner <span class="msg-time float-end">8
                                                        min
                                                        ago</span></h6>
                                                <p class="msg-info">Various versions have evolved over</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="user-online">
                                                <img src="{{ asset('adminbackend/assets/images/avatars/avatar-4.png') }}"
                                                    class="msg-avatar" alt="user avatar">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">Katherine Pechon <span
                                                        class="msg-time float-end">15
                                                        min ago</span></h6>
                                                <p class="msg-info">Making this the first true generator</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="user-online">
                                                <img src="{{ asset('adminbackend/assets/images/avatars/avatar-5.png') }}"
                                                    class="msg-avatar" alt="user avatar">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">Amelia Doe <span class="msg-time float-end">22
                                                        min
                                                        ago</span></h6>
                                                <p class="msg-info">Duis aute irure dolor in reprehenderit</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="user-online">
                                                <img src="{{ asset('adminbackend/assets/images/avatars/avatar-6.png') }}"
                                                    class="msg-avatar" alt="user avatar">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">Cristina Jhons <span class="msg-time float-end">2
                                                        hrs
                                                        ago</span></h6>
                                                <p class="msg-info">The passage is attributed to an unknown</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="user-online">
                                                <img src="{{ asset('adminbackend/assets/images/avatars/avatar-7.png') }}"
                                                    class="msg-avatar" alt="user avatar">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">James Caviness <span class="msg-time float-end">4
                                                        hrs
                                                        ago</span></h6>
                                                <p class="msg-info">The point of using Lorem</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="user-online">
                                                <img src="{{ asset('adminbackend/assets/images/avatars/avatar-8.png') }}"
                                                    class="msg-avatar" alt="user avatar">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">Peter Costanzo <span class="msg-time float-end">6
                                                        hrs
                                                        ago</span></h6>
                                                <p class="msg-info">It was popularised in the 1960s</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="user-online">
                                                <img src="{{ asset('adminbackend/assets/images/avatars/avatar-9.png') }}"
                                                    class="msg-avatar" alt="user avatar">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">David Buckley <span class="msg-time float-end">2
                                                        hrs
                                                        ago</span></h6>
                                                <p class="msg-info">Various versions have evolved over</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="user-online">
                                                <img src="{{ asset('adminbackend/assets/images/avatars/avatar-10.png') }}"
                                                    class="msg-avatar" alt="user avatar">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">Thomas Wheeler <span class="msg-time float-end">2
                                                        days
                                                        ago</span></h6>
                                                <p class="msg-info">If you are going to use a passage</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="user-online">
                                                <img src="{{ asset('adminbackend/assets/images/avatars/avatar-11.png') }}"
                                                    class="msg-avatar" alt="user avatar">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">Johnny Seitz <span class="msg-time float-end">5
                                                        days
                                                        ago</span></h6>
                                                <p class="msg-info">All the Lorem Ipsum generators</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <a href="javascript:;">
                                    <div class="text-center msg-footer">View All Messages</div>
                                </a>
                            </div>
                        </li>
                    </div>
                    
                </ul>
            </div>


            @php
                $id = Auth::user()->id;
                $adminData = App\Models\User::find($id);

            @endphp

            <div class="user-box dropdown">
                <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">


                    <img src="{{ !empty($adminData->photo) ? url('upload/admin_images/' . $adminData->photo) : url('upload/no_image.jpg') }}"
                        class="user-img" alt="user avatar">


                    <div class="user-info ps-3">
                        <p class="user-name mb-0">{{ Auth::user()->name }}</p>
                        <p class="designattion mb-0">{{ Auth::user()->username }}</p>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('admin.profile') }}"><i
                                class="bx bx-user"></i><span>Profile</span></a>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('admin.change.password') }}"><i
                                class="bx bx-cog"></i><span>Change Password</span></a>
                    </li>
                    <li>
                        <div class="dropdown-divider mb-0"></div>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('admin.logout') }}"><i
                                class='bx bx-log-out-circle'></i><span>Log out</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <script type="text/javascript">
        function updateStatusNewOrder(id) {
            $.ajax({
                type: "GET",
                url: "/update-status/new-order/" + id,
                dataType: "json",
                success: function(data) {

                }
            });
        }
    </script>
    <script type="text/javascript">
        function updateStatusReturnOrder(id) {
            $.ajax({
                type: "GET",
                url: "/update-status/return-order/" + id,
                dataType: "json",
                success: function(data) {

                }
            });
        }
    </script>
    <script type="text/javascript">
        function updateStatusCancelOrder(id) {
            $.ajax({
                type: "GET",
                url: "/update-status/cancel-order/" + id,
                dataType: "json",
                success: function(data) {

                }
            });
        }
    </script>
    <script type="text/javascript">
        function updateStatusNewCustomer(id) {
            $.ajax({
                type: "GET",
                url: "/update-status/new-customer/" + id,
                dataType: "json",
                success: function(data) {

                }
            });
        }
    </script>
    <script type="text/javascript">
        function updateStatusNewVendor(id) {
            $.ajax({
                type: "GET",
                url: "/update-status/new-vendor/" + id,
                dataType: "json",
                success: function(data) {

                }
            });
        }
    </script>
    <script type="text/javascript">
        function updateStatusBlogComment(id) {
            $.ajax({
                type: "GET",
                url: "/update-status/blog-comment/" + id,
                dataType: "json",
                success: function(data) {

                }
            });
        }
    </script>
    <script type="text/javascript">
        function updateStatusNewContactMessage(id) {
            $.ajax({
                type: "GET",
                url: "/update-status/new-contact-message/" + id,
                dataType: "json",
                success: function(data) {

                }
            });
        }
    </script>
    <script type="text/javascript">
        function updateStatusNewReviewProduct(id) {
            $.ajax({
                type: "GET",
                url: "/update-status/new-review-product/" + id,
                dataType: "json",
                success: function(data) {

                }
            });
        }
    </script>
    <script type="text/javascript">
        function updateStatusNewSubscriber(id) {
            $.ajax({
                type: "GET",
                url: "/update-status/new-subscriber/" + id,
                dataType: "json",
                success: function(data) {

                }
            });
        }
    </script>
</header>
