
@can('access-panel')
    <div class="col-sm-12 p-0 m-auto d-md-none d-block pb-3">
        <div class="d-flex flex-row align-items-center justify-content-between w-100">
            <i class="feather icon-arrow-left-circle"></i>
            <div class="w-100 p-0" id="dashboard-list" style="list-style-type: none;">
                <li href="" class="dashboard-bg-active">
                    <a href="{{url('/user-dashboard')}}">
                        <i class="feather icon-shopping-bag"></i>
                        سفارشات من
                    </a>
                </li>
                <li class="">
                    {{--                        <div class="active"></div>--}}
                    <a href="{{url('/user-dashboard-information')}}">
                        <i class="feather icon-user"></i>
                        اطلاعات کاربری
                    </a>
                </li>
                <li class="">
                    {{--                        <div class="active"></div>--}}
                    <a href="{{url('/user-dashboard-comments')}}">
                        <i class="feather icon-message-square"></i>
                        دیدگاه‌ها
                    </a>
                </li>
                <li class="">
                    {{--                        <div class="active"></div>--}}
                    <a href="">
                        <i class="feather icon-log-out"></i>
                        خروج
                    </a>
                </li>
            </div>
            <i class="feather icon-arrow-right-circle"></i>
        </div>
    </div>
    <div class="d-flex align-items-center justify-content-between p-1 mx-1">
        <h6 class="pr-1 mt-2 mr-1" style="font-size: 12px;font-weight: 500"><span style="color: gray;font-size: 12px"><i class="feather icon-user"></i> داشبورد </span>{{auth()->user()->name}}</h6>
        <h6 class="pr-1 mt-2 mr-1" style="font-size: 12px;font-weight: 500"><a href=""> <i class="feather icon-slash"></i> </a></h6>
    </div>
    <div class="card-body p-0">
        <div class="dashboard-box  nav-container {{isActive('admin.orders', 'dashboard-bg-active')}}" >
            <div class="{{isActive('admin.orders', 'active')}}"></div>
            <div class="dashboard-box-title d-flex flex-row align-items-center justify-content-between">
                <div>
                    <i class="feather icon-shopping-bag"></i>
                    سفارشات  <div class="badge badge-pill badge-danger badge-up" style="padding: 0.4rem;border-radius: 11px;font-weight: 500;min-width: 22px;height: 20px;font-size: 12px">{{\App\Models\Order::where('status','=','completed')->get()->count()}}</div>
                </div>
                <i class="feather icon-arrow-down-circle"></i>

            </div>
            <ul class="nav-items {{isActive('admin.orders', 'update-height')}}">
                <li>
                    <a href="{{url('admin/orders?type=completed&search=')}}">بررسی نشده <div class="badge badge-pill badge-danger badge-up" style="padding: 0.4rem;border-radius: 11px;font-weight: 500;min-width: 22px;height: 20px;font-size: 12px">{{\App\Models\Order::where('status','=','completed')->get()->count()}}</div></a>
                </li>
                <li>
                    <a href="{{url('admin/orders?type=delivered&search=')}}">همه سفارشات</a>
                </li>
            </ul>
        </div>
        <div class="dashboard-box nav-container {{isActive(['admin.books.index','admin.books.create','admin.books.edit','admin.categories.index','admin.translators.index','admin.writers.index'], 'dashboard-bg-active')}}">
            <div class="{{isActive(['admin.books.index','admin.books.create','admin.books.edit','admin.categories.index','admin.writer.index','admin.translators.index'], 'active')}}"></div>
            <div class="dashboard-box-title d-flex flex-row align-items-center justify-content-between">
                <div>
                    <i class="feather icon-book"></i>
                    کتاب‌‌ها
                </div>
                <i class="feather icon-arrow-down-circle"></i>
            </div>
            <ul class="nav-items  {{isActive(['admin.books.index','admin.books.create','admin.books.edit','admin.categories.index','admin.writers.index','admin.translators.index'],'update-height')}} ">
                <li>
                    <a href="{{route('admin.books.index')}}">مدیریت کتاب‌ها</a>
                </li>
                <li>
                    <a href="{{route('admin.categories.index')}}">مدیریت دسته‌بندی‌ها</a>
                </li>
                <li>
                    <a href="{{route('admin.writers.index')}}">مدیریت نویسندگان</a>
                </li>
                <li>
                    <a href="{{route('admin.translators.index')}}">مدیریت مترجمان</a>
                </li>
            </ul>
        </div>
        <div class="dashboard-box {{isActive(['admin.publish-request.index','admin.publish-request.create'], 'dashboard-bg-active')}}">
            <a href="{{route('admin.publish-request.index')}}">
                <div class="{{isActive(['admin.publish-request.index','admin.publish-request.create'], 'active')}}"></div>
                <div class="dashboard-box-title">
                    <i class="feather icon-printer"></i>
                    درخواست چاپ
                </div>
            </a>
        </div>
        <div class="dashboard-box {{isActive(['admin.deliver-book.index','admin.deliver-book.edit'], 'dashboard-bg-active')}}">
            <a href="{{route('admin.deliver-book.index')}}">
                <div class="{{isActive(['admin.deliver-book.index','admin.deliver-book.edit'], 'active')}}"></div>
                <div class="dashboard-box-title">
                    <i class="feather icon-user-check"></i>
                    تحویل کتاب (به مولف،...)
                </div>
            </a>
        </div>
        <div class="dashboard-box {{isActive(['admin.other-sale.index','admin.other-sale.edit'], 'dashboard-bg-active')}}">
            <a href="{{route('admin.other-sale.index')}}">
                <div class="{{isActive(['admin.other-sale.index','admin.other-sale.edit'], 'active')}}"></div>
                <div class="dashboard-box-title">
                    <i class="feather icon-dollar-sign"></i>
                    ثبت فروش(نمایشگاه‌ها و ...)
                </div>
            </a>
        </div>

        <div class="dashboard-box {{isActive('admin.report', 'dashboard-bg-active')}}">
            <a href="{{route('admin.report')}}">
                <div class="{{isActive('admin.report', 'active')}}"></div>
                <div class="dashboard-box-title">
                    <i class="feather icon-bar-chart"></i>
                    گزارش فروش
                </div>
            </a>
        </div>
        <div class="dashboard-box nav-container {{isActive(['admin.comments.pending','admin.comments.manage','admin.comments.reject'], 'dashboard-bg-active')}}">
            <div class="{{isActive(['admin.comments.pending','admin.comments.manage','admin.comments.reject'], 'active')}}"></div>
            <div class="dashboard-box-title d-flex flex-row align-items-center justify-content-between">
                <div>
                    <i class="feather icon-printer"></i>
                    دیدگاه‌ها <div class="badge badge-pill badge-danger badge-up" style="padding: 0.4rem;border-radius: 11px;font-weight: 500;min-width: 22px;height: 20px;font-size: 12px">{{\App\Models\Comment::where('approved','=','0')->get()->count()}}</div>
                </div>
                <i class="feather icon-arrow-down-circle"></i>
            </div>
            <ul class="nav-items {{isActive(['admin.comments.pending','admin.comments.manage','admin.comments.reject'], 'update-height')}}">
                <li >
                    <a href="{{route('admin.comments.pending')}}" class="active-link">بررسی نشده</a>
                </li>
                <li>
                    <a href="{{route('admin.comments.manage')}}">مدیریت</a>
                </li>
            </ul>
        </div>
        <div class="dashboard-box {{isActive(['admin.users.index','admin.users.permissions.create'], 'dashboard-bg-active')}}">
            <div class="{{isActive(['admin.users.index','admin.users.permissions.create'], 'active')}}"></div>
            <a href="{{route('admin.users.index')}}">
                <div class="dashboard-box-title">
                    <i class="feather icon-users"></i>
                    مدیریت کاربران
                </div>
            </a>
        </div>
        @can('show-access-management')
        <div class="dashboard-box nav-container {{isActive(['admin.permissions.index','admin.roles.index'], 'dashboard-bg-active')}}">
            <div class="{{isActive(['admin.permissions.index','admin.roles.index'], 'active')}}"></div>
            <div class="dashboard-box-title d-flex flex-row align-items-center justify-content-between">
                <div>
                    <i class="feather icon-stop-circle"></i>
                    مدیریت دسترسی‌ها
                </div>
                <i class="feather icon-arrow-down-circle"></i>
            </div>
            <ul class="nav-items {{isActive(['admin.permissions.index','admin.roles.index'], 'update-height')}}">
                <li >
                    <a href="{{route('admin.permissions.index')}}" class="active-link">دسترسی‌ها</a>
                </li>
                <li>
                    <a href="{{route('admin.roles.index')}}">نقش‌ها</a>
                </li>
            </ul>
        </div>
        @endcan
        <div class="dashboard-box {{isActive(['admin.user.orders'], 'dashboard-bg-active')}}">
            <div class="{{isActive(['admin.user.orders'], 'active')}}"></div>
            <a href="{{route('admin.user.orders')}}">
                <div class="dashboard-box-title">
                    <i class="feather icon-shopping-bag"></i>
                    سفارشات من
                </div>
            </a>
        </div>
        <div class="dashboard-box {{isActive(['admin.discount-code.index'], 'dashboard-bg-active')}}">
            <div class="{{isActive(['admin.discount-code.index'], 'active')}}"></div>
            <a href="{{route('admin.discount-code.index')}}">
                <div class="dashboard-box-title">
                    <i class="feather icon-percent"></i>
                    مدیریت کد تخفیف
                </div>
            </a>
        </div>
        <div class="dashboard-box {{isActive(['admin.news.index'], 'dashboard-bg-active')}}">
            <div class="{{isActive(['admin.news.index'], 'active')}}"></div>
            <a href="{{route('admin.news.index')}}">
                <div class="dashboard-box-title">
                    <i class="feather icon-info"></i>
                    اخبار و اطلاعیه‌ها
                </div>
            </a>
        </div>
        <div class="dashboard-box {{isActive(['admin.setting.index'], 'dashboard-bg-active')}}">
            <div class="{{isActive(['admin.setting.index'], 'active')}}"></div>
            <a href="{{route('admin.setting.index')}}">
                <div class="dashboard-box-title">
                    <i class="feather icon-info"></i>
                    اطلاعات سامانه
                </div>
            </a>
        </div>

        <div class="dashboard-box">
            <a href="{{url('/admin-info')}}">
                <div class="dashboard-box-title">
                    <i class="feather icon-user"></i>
                    اطلاعات کاربری
                </div>
            </a>
        </div>

        <div class="dashboard-box" style="">
            {{--                        <div class="active"></div>--}}

            <a href="{{route('auth.logout')}}">
                <div class="dashboard-box-title">
                    <i class="feather icon-log-out"></i>
                    خروج
                </div>
            </a>
        </div>
    </div>
@endcan
