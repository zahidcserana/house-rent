<template>
    <div class="m-header__bottom">
        <div
            class="m-container m-container--fluid m-container--full-height m-page__container"
        >
            <div class="m-stack m-stack--ver m-stack--desktop">
                <!-- begin::Horizontal Menu -->
                <div
                    class="m-stack__item m-stack__item--fluid m-header-menu-wrapper"
                >
                    <button
                        class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-light "
                        id="m_aside_header_menu_mobile_close_btn"
                    >
                        <i class="la la-close"></i>
                    </button>
                    <div
                        id="m_header_menu"
                        class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-dark m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-light m-aside-header-menu-mobile--submenu-skin-light "
                    >
                        <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
                            <li
                                :class="getMenu('dashboard')"
                                data-menu-submenu-toggle="tab"
                                aria-haspopup="true"
                            >
                                <a
                                    :href="route('dashboard')"
                                    class="m-menu__link m-menu__toggle"
                                >
                                    <span class="m-menu__link-text">
                                        Dashboard
                                    </span>
                                    <i
                                        class="m-menu__hor-arrow la la-angle-down"
                                    ></i>
                                    <i
                                        class="m-menu__ver-arrow la la-angle-right"
                                    ></i>
                                </a>
                                <div
                                    class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs"
                                >
                                    <span
                                        class="m-menu__arrow m-menu__arrow--adjust"
                                    ></span>
                                    <ul class="m-menu__subnav">
                                        <li :class="getRoute('dashboard')" data-redirect="true" aria-haspopup="true">
                                            <jet-responsive-nav-link :href="route('dashboard')" :active="route().current('dashboard')" class="m-menu__link">
                                                <i class="m-menu__link-icon flaticon-support"></i>
                                                <span class="m-menu__link-text">Dashboard</span>
                                            </jet-responsive-nav-link>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li
                                :class="getMenu('accounting')"
                                data-menu-submenu-toggle="tab"
                                aria-haspopup="true"
                            >
                                <a href="javascript:void(0)" class="m-menu__link m-menu__toggle">
                                    <span class="m-menu__link-text">
                                        Accounting
                                    </span>
                                    <i
                                        class="m-menu__hor-arrow la la-angle-down"
                                    ></i>
                                    <i
                                        class="m-menu__ver-arrow la la-angle-right"
                                    ></i>
                                </a>
                                <div
                                    class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs"
                                >
                                    <span
                                        class="m-menu__arrow m-menu__arrow--adjust"
                                    ></span>
                                    <ul class="m-menu__subnav">
                                        <li :class="getRoute('invoice.index')" data-redirect="true" aria-haspopup="true">
                                            <jet-responsive-nav-link :href="route('invoice.index')" :active="route().current('invoice.index')" class="m-menu__link">
                                                <i class="m-menu__link-icon flaticon-graphic-2"></i>
                                                <span class="m-menu__link-text">Invoice</span>
                                            </jet-responsive-nav-link>
                                        </li>
                                        <li
                                            class="m-menu__item  m-menu__item--actions"
                                            aria-haspopup="true"
                                        >
                                            <div
                                                class="m-menu__link m-menu__link--toggle-skip"
                                            >
                                                <a
                                                    href="#"
                                                    class="btn btn-danger m-btn m-btn--icon m-btn--pill"
                                                >
                                                    <span>
                                                        <i
                                                            class="la la-cloud-download"
                                                        ></i>
                                                        <span>
                                                            Generate report
                                                        </span>
                                                    </span>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li
                                :class="getMenu('settings')"
                                data-menu-submenu-toggle="tab"
                                aria-haspopup="true"
                            >
                                <a href="javascript:void(0);" class="m-menu__link m-menu__toggle">
                                    <span class="m-menu__link-text">
                                        Settings
                                    </span>
                                    <i
                                        class="m-menu__hor-arrow la la-angle-down"
                                    ></i>
                                    <i
                                        class="m-menu__ver-arrow la la-angle-right"
                                    ></i>
                                </a>
                                <div
                                    class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs"
                                >
                                    <span
                                        class="m-menu__arrow m-menu__arrow--adjust"
                                    ></span>
                                    <ul class="m-menu__subnav">
                                        <li :class="getRoute('house.index')" data-redirect="true" aria-haspopup="true">
                                            <jet-responsive-nav-link :href="route('house.index')" :active="route().current('house.index')" class="m-menu__link">
                                                <i class="m-menu__link-icon flaticon-graphic-2"></i>
                                                <span class="m-menu__link-text">House</span>
                                            </jet-responsive-nav-link>
                                        </li>
                                        <li :class="getRoute('flat.index')" data-redirect="true" aria-haspopup="true">
                                            <jet-responsive-nav-link :href="route('flat.index')" :active="route().current('flat.index')" class="m-menu__link">
                                                <i class="m-menu__link-icon flaticon-graphic-1"></i>
                                                <span class="m-menu__link-text">Flat</span>
                                            </jet-responsive-nav-link>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li
                                :class="getMenu('users')"
                                data-menu-submenu-toggle="tab"
                                aria-haspopup="true"
                            >
                                <a href="javascript:void(0);" class="m-menu__link m-menu__toggle">
                                    <span class="m-menu__link-text">
                                        Users
                                    </span>
                                    <i
                                        class="m-menu__hor-arrow la la-angle-down"
                                    ></i>
                                    <i
                                        class="m-menu__ver-arrow la la-angle-right"
                                    ></i>
                                </a>
                                <div
                                    class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs"
                                >
                                    <span
                                        class="m-menu__arrow m-menu__arrow--adjust"
                                    ></span>
                                    <ul class="m-menu__subnav">
                                        <li :class="getRoute('user.index')" data-redirect="true" aria-haspopup="true">
                                            <jet-responsive-nav-link :href="route('user.index')" :active="route().current('user.index')" class="m-menu__link">
                                                <i class="m-menu__link-icon flaticon-imac"></i>
                                                <span class="m-menu__link-text">User</span>
                                            </jet-responsive-nav-link>
                                        </li>
                                        <li :class="getRoute('role.index')" data-redirect="true" aria-haspopup="true">
                                            <jet-responsive-nav-link :href="route('role.index')" :active="route().current('role.index')" class="m-menu__link">
                                                <i class="m-menu__link-icon flaticon-analytics"></i>
                                                <span class="m-menu__link-text">Role</span>
                                            </jet-responsive-nav-link>
                                        </li>
                                        <li :class="getRoute('customer.index')" data-redirect="true" aria-haspopup="true">
                                            <jet-responsive-nav-link :href="route('customer.index')" :active="route().current('customer.index')" class="m-menu__link">
                                                <i class="m-menu__link-icon flaticon-settings-1"></i>
                                                <span class="m-menu__link-text">Customer</span>
                                            </jet-responsive-nav-link>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li
                                class="m-menu__item  m-menu__item--submenu m-menu__item--tabs"
                                data-menu-submenu-toggle="tab"
                                aria-haspopup="true"
                            >
                                <a href="#" class="m-menu__link m-menu__toggle">
                                    <span class="m-menu__link-text">
                                        Reports
                                    </span>
                                    <i
                                        class="m-menu__hor-arrow la la-angle-down"
                                    ></i>
                                    <i
                                        class="m-menu__ver-arrow la la-angle-right"
                                    ></i>
                                </a>
                                <div
                                    class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs"
                                >
                                    <span
                                        class="m-menu__arrow m-menu__arrow--adjust"
                                    ></span>
                                    <ul class="m-menu__subnav">
                                        <li
                                            class="m-menu__item "
                                            data-redirect="true"
                                            aria-haspopup="true"
                                        >
                                            <a
                                                href="builder.html"
                                                class="m-menu__link "
                                            >
                                                <i
                                                    class="m-menu__link-icon flaticon-graphic-2"
                                                ></i>
                                                <span class="m-menu__link-text">
                                                    Orders
                                                </span>
                                            </a>
                                        </li>
                                        <li
                                            class="m-menu__item "
                                            data-redirect="true"
                                            aria-haspopup="true"
                                        >
                                            <a
                                                href="builder.html"
                                                class="m-menu__link "
                                            >
                                                <i
                                                    class="m-menu__link-icon flaticon-analytics"
                                                ></i>
                                                <span class="m-menu__link-text">
                                                    Customers
                                                </span>
                                            </a>
                                        </li>
                                        <li
                                            class="m-menu__item "
                                            aria-haspopup="true"
                                        >
                                            <a
                                                href="inner.html"
                                                class="m-menu__link "
                                            >
                                                <i
                                                    class="m-menu__link-icon flaticon-notes"
                                                ></i>
                                                <span class="m-menu__link-text">
                                                    Revenue
                                                </span>
                                            </a>
                                        </li>
                                        <li
                                            class="m-menu__item "
                                            data-redirect="true"
                                            aria-haspopup="true"
                                        >
                                            <a
                                                href="builder.html"
                                                class="m-menu__link "
                                            >
                                                <i
                                                    class="m-menu__link-icon flaticon-clipboard"
                                                ></i>
                                                <span class="m-menu__link-text">
                                                    Invoices
                                                </span>
                                            </a>
                                        </li>
                                        <li
                                            class="m-menu__item "
                                            data-redirect="true"
                                            aria-haspopup="true"
                                        >
                                            <a
                                                href="builder.html"
                                                class="m-menu__link "
                                            >
                                                <i
                                                    class="m-menu__link-icon flaticon-alarm-1"
                                                ></i>
                                                <span class="m-menu__link-text">
                                                    Bills
                                                </span>
                                            </a>
                                        </li>
                                        <li
                                            class="m-menu__item  m-menu__item--actions"
                                            aria-haspopup="true"
                                        >
                                            <div
                                                class="m-menu__link m-menu__link--toggle-skip"
                                            >
                                                <div class="dropdown">
                                                    <a
                                                        href="#"
                                                        class="btn btn-primary m-btn m-btn--icon m-btn--pill m-btn--air   dropdown-toggle"
                                                        data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false"
                                                    >
                                                        <i
                                                            class="la la-cloud-download"
                                                        ></i>
                                                        &nbsp;&nbsp;Export
                                                    </a>
                                                    <div
                                                        class="dropdown-menu dropdown-menu-right"
                                                    >
                                                        <a
                                                            class="dropdown-item"
                                                            href="#"
                                                        >
                                                            <i
                                                                class="flaticon-share"
                                                            ></i>
                                                            Action
                                                        </a>
                                                        <a
                                                            class="dropdown-item"
                                                            href="#"
                                                        >
                                                            <i
                                                                class="flaticon-settings"
                                                            ></i>
                                                            Another action
                                                        </a>
                                                        <a
                                                            class="dropdown-item"
                                                            href="#"
                                                        >
                                                            <i
                                                                class="flaticon-graphic-2"
                                                            ></i>
                                                            Something else
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- end::Horizontal Menu -->
            </div>
        </div>
    </div>
</template>

<script>
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'

export default {
    components: {
        JetResponsiveNavLink
    },
    props: ['croute', 'proute'],
    methods: {
        getRoute(path) {
            if(this.croute === path) {
                return 'm-menu__item  m-menu__item--active'
            }
            return 'm-menu__item'
        },
        getMenu(menu) {
            const settings = ['house', 'flat']
            const users = ['user', 'customer', 'role']
            const dashboard = ['dashboard']
            const accounting = ['invoice']

            if(menu === 'settings' && settings.includes(this.proute)) {
                return 'm-menu__item  m-menu__item--active  m-menu__item--active-tab  m-menu__item--submenu m-menu__item--tabs'
            } else if(menu === 'dashboard' && dashboard.includes(this.proute)) {
                return 'm-menu__item  m-menu__item--active  m-menu__item--active-tab  m-menu__item--submenu m-menu__item--tabs'
            } else if(menu === 'accounting' && accounting.includes(this.proute)) {
                return 'm-menu__item  m-menu__item--active  m-menu__item--active-tab  m-menu__item--submenu m-menu__item--tabs'
            } else if(menu === 'users' && users.includes(this.proute)) {
                return 'm-menu__item  m-menu__item--active  m-menu__item--active-tab  m-menu__item--submenu m-menu__item--tabs'
            }
            return 'm-menu__item  m-menu__item--submenu m-menu__item--tabs'
        }
    }
}
</script>
