<aside class="app-sidebar sticky" id="sidebar">

    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header">
        <a href="#" class="header-logo">
            @php
            $logo = asset(\App\Models\LogoFaviconSetting::first()->logo);
            @endphp
            <img src="{{ asset($logo) }}" alt="logo" class="desktop-logo">
            <img src="{{ asset($logo) }}" alt="logo" class="toggle-logo">
            <img src="{{ asset($logo) }}" alt="logo" class="logo">
            <img src="{{ asset($logo) }}" alt="logo" class="toggle-dark">
        </a>
    </div>
    <!-- End::main-sidebar-header -->

    <!-- Start::main-sidebar -->
    <div class="main-sidebar" id="sidebar-scroll">

        <!-- Start::nav -->
        <nav class="main-menu-container nav nav-pills flex-column sub-open">
            <div class="slide-left" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                </svg>
            </div>
            <ul class="main-menu">
                <!-- Start::slide__category -->
                <li class="slide__category"><span class="category-name">Main</span></li>
                <!-- End::slide__category -->

                <li class="slide">
                    <a href="{{ route('dashboard') }}" class="side-menu__item">
                        <i class="bx bx-home side-menu__icon"></i>
                        <span class="side-menu__label">Dashboard</span>
                    </a>
                </li>



                <!-- Start::slide__category -->
                <li class="slide__category"><span class="category-name">Manage</span></li>
                <!-- End::slide__category -->

                <!-- Start::User -->
                <li class="slide">
                    <a href="{{ route('users') }}" class="side-menu__item">
                        <i class="bx bx-user side-menu__icon"></i>
                        <span class="side-menu__label">Users</span>
                    </a>
                </li>
                <!-- End::User -->
                <!-- Start::Lottery -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="bx bx-barcode side-menu__icon"></i>
                        <span class="side-menu__label">Manage Contest</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Manage Contest</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('lotteries') }}" class="side-menu__item">Contests</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('manual.draw') }}" class="side-menu__item">Manual Draw</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('purchase.statement') }}" class="side-menu__item">Purchase Statement</a>
                        </li>
                    </ul>
                </li>
                <!-- End::Lottery -->

                <!-- start Scratch Card --->
                  <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="bx bx-barcode side-menu__icon"></i>
                        <span class="side-menu__label">Scratch Card</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Scratch Card</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('scratchcard') }}" class="side-menu__item">All Cards</a>
                        </li>
                    </ul>
                </li>
                <!-- End Scratch Card --->

                <li class="slide__category"><span class="category-name">Wallets</span></li>

                <!-- Start::Deposits -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="bx bx-wallet side-menu__icon"></i>
                        <span class="side-menu__label">Deposits</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Deposits</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('pending.deposits') }}" class="side-menu__item">Pending Deposits</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('approved.deposits') }}" class="side-menu__item">Approved Deposits</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('rejected.deposits') }}" class="side-menu__item">Rejected Deposits</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('all.deposits') }}" class="side-menu__item">All Deposits</a>
                        </li>
                    </ul>
                </li>
                <!-- End::Deposits -->

                <!-- Start::Withdraws -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="bx bx-money-withdraw side-menu__icon"></i>
                        <span class="side-menu__label">Withdraws</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Withdraws</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('withdraw.gateways') }}" class="side-menu__item">Withdraw Methods</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('pending.withdraw') }}" class="side-menu__item">Pending Withdraws</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('approved.withdraw') }}" class="side-menu__item">Approved Withdraws</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('rejected.withdraw') }}" class="side-menu__item">Rejected Withdraws</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('all.withdraw') }}" class="side-menu__item">All Withdraws</a>
                        </li>
                    </ul>
                </li>
                <!-- End::Withdraws -->

                <!-- Start::Report -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="bx bxs-report side-menu__icon"></i>
                        <span class="side-menu__label">Report</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Report</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('ticket.log') }}" class="side-menu__item">Sold Ticket Log</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('winner.log') }}" class="side-menu__item">Winner Log</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('referral.log') }}" class="side-menu__item">Referral Log</a>
                        </li>
                    </ul>
                </li>
                <!-- End::Report -->
                <li class="slide__category"><span class="category-name">Sliders</span></li>

                <!-- Start::Sliders -->
                <li class="slide">
                    <a href="{{ route('sliders') }}" class="side-menu__item">
                        <i class="bx bx-image side-menu__icon"></i>
                        <span class="side-menu__label">Sliders</span>
                    </a>
                </li>
                <!-- End::Sliders -->


                <li class="slide__category"><span class="category-name">Notifications</span></li>

                <!-- Start::Notification -->
                <li class="slide">
                    <a href="{{ route('notification') }}" class="side-menu__item">
                        <i class="bx bx-notification side-menu__icon"></i>
                        <span class="side-menu__label">Send Notification</span>
                    </a>
                </li>
                <!-- End::Notification -->

                <!-- Start::Firebase -->
                <li class="slide">
                    <a href="{{ route('fcm') }}" class="side-menu__item">
                        <i class="bx bx-notification side-menu__icon"></i>
                        <span class="side-menu__label">Firebase Config</span>
                    </a>
                </li>
                <!-- End::Firebase -->


                <li class="slide__category"><span class="category-name">Payment Settings</span></li>

                <!-- Start::Payment Methods -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="bx bx-money side-menu__icon"></i>
                        <span class="side-menu__label">Payment Gateways</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Payment Gateways</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('gateways') }}" class="side-menu__item">Manual Gateways</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('auto.gateways') }}" class="side-menu__item">Automatic Gateways</a>
                        </li>
                    </ul>
                </li>
                <!-- End::Payment Methods -->


                <li class="slide__category"><span class="category-name">System Settings</span></li>


                <!-- Start::Settings -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="bx bx-cog side-menu__icon"></i>
                        <span class="side-menu__label">Settings</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Settings</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('general.setting.view') }}" class="side-menu__item">General Setting</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('refer.setting.view') }}" class="side-menu__item">Referral Setting</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('app.version.setting') }}" class="side-menu__item">App Version Setting</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('logo.setting') }}" class="side-menu__item">Logo Setting</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('smtp.update.view') }}" class="side-menu__item">SMTP Config</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('maintenance.setting.view') }}" class="side-menu__item">Maintenance
                                Setting</a>
                        </li>
                    </ul>
                </li>
                <!-- End::Settings -->

            </ul>

        </nav>
        <!-- End::nav -->

    </div>
    <!-- End::main-sidebar -->

</aside>
