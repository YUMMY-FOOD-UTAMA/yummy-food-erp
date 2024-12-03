<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
     data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
     data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo" style="background-color: #C3252B !important;">
        <a href="{{ route('dashboard') }}" class="mt-5 d-flex align-items-end">
            <img alt="Logo" src="{{ asset('assets/images/logo.png') }}" class="h-45px app-sidebar-logo-default"/>
            <img alt="Logo" src="{{ asset('assets/images/logo.png') }}"
                 class="h-20px app-sidebar-logo-minimize"/>
            <span class="fw-bold fs-2 text-white text-logo">rp</span>
        </a>

        <div id="kt_app_sidebar_toggle"
             class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
             data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
             data-kt-toggle-name="app-sidebar-minimize">
            <span class="svg-icon svg-icon-2 rotate-180">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.5"
                          d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                          fill="currentColor"/>
                    <path
                        d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                        fill="currentColor"/>
                </svg>
            </span>
        </div>
    </div>

    <div class="app-sidebar-menu overflow-hidden flex-column-fluid" style="background-color: #C3252B !important;">
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5"
             data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
             data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px"
             data-kt-scroll-save-state="true">
            <div class="menu menu-column menu-rounded menu-sub-indention px-3 sidebar-menu-admin"
                 id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                @can('dashboard')
                    <div class="menu-item">
                        <a class="menu-link {{ Route::is('dashboard') ? 'active' : '' }}"
                           href="{{ route('dashboard') }}">
                       <span class="menu-icon">
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                        </i>
                       </span>
                            <span class="menu-title">Dashboards</span>
                        </a>
                    </div>
                @endcan()

                <div class="menu-item pt-5">
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">Pages</span>
                    </div>
                </div>

                @if(Auth::user()->hasPermissionStartingWith('user-management.'))
                    <div data-kt-menu-trigger="click"
                         class="{{Route::is('user-management.*')? 'show':''}} menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25"/>
                                </svg>
                            </i>
                        </span>
                        <span class="menu-title">User Management</span>
                        <span class="menu-arrow"></span>
                    </span>
                        <div class="menu-sub menu-sub-accordion">
                            @can('user-management.employee.index')
                                <div class="menu-item">
                                    <a class="menu-link {{ Route::is('user-management.employee.*') && !Route::is('user-management.employee.sales.*') ? 'active' : '' }}"
                                       href="{{ route('user-management.employee.index') }}">
                                        <i class="bi bi-person-circle menu-icon"></i>
                                        <span class="menu-title">All Department</span>
                                    </a>
                                </div>
                            @endcan
                            @can('user-management.employee.sales.index')
                                <div class="menu-item">
                                    <a class="menu-link {{ Route::is('user-management.employee.sales.*') ? 'active' : '' }}"
                                       href="{{ route('user-management.employee.sales.index') }}">
                                        <i class="bi bi-person-circle menu-icon"></i>
                                        <span class="menu-title">Sales Department</span>
                                    </a>
                                </div>
                            @endcan

                            @can('user-management.role-management.index')
                                <div class="menu-item">
                                    <a class="menu-link {{ Route::is('user-management.role-management.*') ? 'active' : '' }}"
                                       href="{{ route('user-management.role-management.index') }}">
                                <span class="menu-icon">
                                <i>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-person-vcard" viewBox="0 0 16 16">
                                        <path
                                            d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4m4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5M9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8m1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5"/>
                                        <path
                                            d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96q.04-.245.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 1 1 12z"/>
                                    </svg>
                                </i>
                                </span>
                                        <span class="menu-title">Role Management</span>
                                    </a>
                                </div>
                            @endcan

                        </div>
                    </div>
                @endif

                @if(Auth::user()->hasPermissionStartingWith('receivable.'))
                    <div data-kt-menu-trigger="click"
                         class="menu-item menu-accordion {{Route::is('receivable.*') ? 'show':''}}">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 8c-2.209 0-4 1.791-4 4s1.791 4 4 4 4-1.791 4-4-1.791-4-4-4zm0-2c3.314 0 6 2.686 6 6s-2.686 6-6 6-6-2.686-6-6 2.686-6 6-6zm6 12.727v.773a2 2 0 0 1-2 2h-8a2 2 0 0 1-2-2v-.773A7.954 7.954 0 0 0 12 20c2.536 0 4.846-1.17 6-3.273z"/>
                                </svg>
                            </i>
                        </span>
                        <span class="menu-title">Account Receivable</span>
                        <span class="menu-arrow"></span>
                    </span>
                        <div class="menu-sub menu-sub-accordion">
                            @if(Auth::user()->hasPermissionStartingWith('receivable.crm.'))
                                <div data-kt-menu-trigger="click"
                                     class="menu-item menu-accordion {{Route::is('receivable.crm.*')?'show':''}}">
                                    <span class="menu-link">
                                        <span class="menu-icon">
                                            <i>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M16 11V7a4 4 0 10-8 0v4M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804"/>
                                                </svg>
                                            </i>
                                        </span>
                                        <span class="menu-title">CRM</span>
                                        <span class="menu-arrow"></span>
                                    </span>
                                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                                        @can('receivable.crm.sales-mapping.index')
                                            <div class="menu-item">
                                                <a class="menu-link {{Route::is('receivable.crm.sales-mapping.*')?'active':''}}"
                                                   href="{{route('receivable.crm.sales-mapping.index')}}">
                                                    <span class="menu-icon">
                                                        <i>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                 height="16"
                                                                 fill="currentColor" class="bi bi-diagram-3"
                                                                 viewBox="0 0 16 16">
                                                              <path fill-rule="evenodd"
                                                                    d="M6 3.5A1.5 1.5 0 0 1 7.5 2h1A1.5 1.5 0 0 1 10 3.5v1A1.5 1.5 0 0 1 8.5 6v1H14a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0v-1A.5.5 0 0 1 2 7h5.5V6A1.5 1.5 0 0 1 6 4.5zM8.5 5a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5zM0 11.5A1.5 1.5 0 0 1 1.5 10h1A1.5 1.5 0 0 1 4 11.5v1A1.5 1.5 0 0 1 2.5 14h-1A1.5 1.5 0 0 1 0 12.5zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm4.5.5A1.5 1.5 0 0 1 7.5 10h1a1.5 1.5 0 0 1 1.5 1.5v1A1.5 1.5 0 0 1 8.5 14h-1A1.5 1.5 0 0 1 6 12.5zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm4.5.5a1.5 1.5 0 0 1 1.5-1.5h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z"/>
                                                            </svg>
                                                        </i>
                                                    </span>
                                                    <span class="menu-title">Sales Mapping</span>
                                                </a>
                                            </div>
                                        @endcan

                                        @can('receivable.crm.schedule-visit.index')
                                            <div class="menu-item">
                                                <a class="menu-link {{Route::is('receivable.crm.schedule-visit.*')?'active':''}}"
                                                   href="{{route('receivable.crm.schedule-visit.index')}}">
                                                <span class="menu-icon">
                                                <i>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none"
                                                         viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2" d="M9 12h6M9 8h6M9 16h6"/>
                                                    </svg>
                                                </i>
                                                </span>
                                                    <span class="menu-title">Scheduling Visit</span>
                                                </a>
                                            </div>
                                        @endcan

                                        @can('receivable.crm.sales-approval.index')
                                            <div class="menu-item">
                                                <a class="menu-link {{Route::is('receivable.crm.sales-approval.*')?'active':''}}"
                                                   href="{{route('receivable.crm.sales-approval.index')}}">
                                                    <span class="menu-icon">
                                                        <i>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                                 fill="none"
                                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                      stroke-width="2" d="M5 13l4 4L19 7"/>
                                                            </svg>
                                                        </i>
                                                    </span>
                                                    <span class="menu-title">Sales Approval</span>
                                                </a>
                                            </div>
                                        @endcan

                                        @can('receivable.crm.sales-confirm-visit.index')
                                            <div class="menu-item">
                                                <a class="menu-link {{Route::is('receivable.crm.sales-confirm-visit.*')?'active':''}}"
                                                   href="{{route('receivable.crm.sales-confirm-visit.index')}}">
                                                    <i class="bi bi-check-circle menu-icon"></i>
                                                    <span class="menu-title">Sales Confirm Visit</span>
                                                </a>
                                            </div>
                                        @endcan

                                        @can('receivable.crm.sales-visit-report.index')
                                            <div class="menu-item">
                                                <a class="menu-link {{Route::is('receivable.crm.sales-visit-report.*')?'active':''}}"
                                                   href="{{route('receivable.crm.sales-visit-report.index')}}">
                                                    <span class="menu-icon">
                                                    <i>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                             fill="currentColor" class="bi bi-flag" viewBox="0 0 16 16">
                                                          <path
                                                              d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001M14 1.221c-.22.078-.48.167-.766.255-.81.252-1.872.523-2.734.523-.886 0-1.592-.286-2.203-.534l-.008-.003C7.662 1.21 7.139 1 6.5 1c-.669 0-1.606.229-2.415.478A21 21 0 0 0 3 1.845v6.433c.22-.078.48-.167.766-.255C4.576 7.77 5.638 7.5 6.5 7.5c.847 0 1.548.28 2.158.525l.028.01C9.32 8.29 9.86 8.5 10.5 8.5c.668 0 1.606-.229 2.415-.478A21 21 0 0 0 14 7.655V1.222z"/>
                                                        </svg>
                                                    </i>
                                                    </span>
                                                    <span class="menu-title">Sales Visit Report</span>
                                                </a>
                                            </div>
                                        @endcan
                                    </div>
                                </div>
                            @endif

                            @can('receivable.customer.index')
                                <div class="menu-item">
                                    <a class="menu-link {{Route::is('receivable.customer.*')?'active':''}}"
                                       href="{{route('receivable.customer.index')}}">
                                        <span class="menu-icon">
                                            <i>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z"/>
                                                </svg>
                                            </i>
                                        </span>
                                        <span class="menu-title">List Of Customer</span>
                                    </a>
                                </div>
                            @endcan
                        </div>
                    </div>
                @endif

                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 8c2.21 0 4 1.79 4 4s-1.79 4-4 4m0-8v2m0 0v2m0-2h1m-2 0h-1m-3 0H5v2a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-2h-2m-3 0h-2m0-5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v1M7 3h10"/>
                                </svg>
                            </i>
                        </span>
                        <span class="menu-title">Account Payable</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link"
                               href="../../demo1/dist/authentication/extended/multi-steps-sign-up.html">
                                <span class="menu-icon">
                                    <i>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M12 8v4l3 3m6-7a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </i>
                                </span>
                                <span class="menu-title">........</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 7h18M3 7V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v2M3 7v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V7m-2 10V12m-6 5v-6m-6 6v-4"/>
                                </svg>
                            </i>
                        </span>
                        <span class="menu-title">Inventory</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link"
                               href="../../demo1/dist/authentication/extended/multi-steps-sign-up.html">
                                <span class="menu-icon">
                                    <i>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M3 4h18l-2 12H5L3 4zm4 12a2 2 0 110 4 2 2 0 010-4zm10 0a2 2 0 110 4 2 2 0 010-4z"/>
                                        </svg>
                                    </i>
                                </span>
                                <span class="menu-title">List Of Product</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 10h3v6H3v-6zm0-2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h18a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2h-2V5a1 1 0 0 0-1-1h-5a1 1 0 0 0-1 1v3H6V5a1 1 0 0 0-1-1H3a2 2 0 0 0-2 2v3zm15 3h5v8h-5v-8zm-3 0h-2v8h2v-8zm-6 0H6v8h3v-8z"/>
                                </svg>
                            </i>
                        </span>
                        <span class="menu-title">Production</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link"
                               href="../../demo1/dist/authentication/extended/multi-steps-sign-up.html">
                                <span class="menu-icon">
                                    <i>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M12 8v4l3 3m6-7a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </i>
                                </span>
                                <span class="menu-title">........</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 6h18M3 6V4a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v2M3 6v12a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6M7 6v12"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5 18h0a2 2 0 1 0 0 4h0a2 2 0 1 0 0-4h0zM19 18h0a2 2 0 1 0 0 4h0a2 2 0 1 0 0-4h0z"/>
                                </svg>
                            </i>
                        </span>
                        <span class="menu-title">Delivery</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link"
                               href="../../demo1/dist/authentication/extended/multi-steps-sign-up.html">
                                <span class="menu-icon">
                                    <i>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M12 8v4l3 3m6-7a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </i>
                                </span>
                                <span class="menu-title">........</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5 3h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/>
                                    <!-- Document outline -->
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5 7h14M5 11h14M5 15h14"/> <!-- Lines for text -->
                                </svg>
                            </i>
                        </span>
                        <span class="menu-title">General Ledger</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link"
                               href="../../demo1/dist/authentication/extended/multi-steps-sign-up.html">
                                <span class="menu-icon">
                                    <i>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M12 8v4l3 3m6-7a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </i>
                                </span>
                                <span class="menu-title">........</span>
                            </a>
                        </div>
                    </div>
                </div>
                @can('management_setting.index')
                    <div class="menu-item">
                        <a class="menu-link {{Route::is('management_setting.*')? 'active':''}}"
                           href="{{route('management_setting.index')}}">
                        <span class="menu-icon">
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-sliders" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3m-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1z"/>
                            </svg>
                        </i>
                        </span>
                            <span class="menu-title">Management Setting</span>
                        </a>
                    </div>
                @endcan
            </div>
        </div>
    </div>
</div>
