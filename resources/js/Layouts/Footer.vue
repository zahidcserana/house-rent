<template>
    <footer class="m-grid__item m-footer ">
        <div class="m-container m-container--fluid m-container--full-height m-page__container">
            <div class="m-footer__wrapper">
                <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
                    <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
                        <span class="m-footer__copyright">
                            2017 &copy; Metronic theme by
                            <a href="https://keenthemes.com" class="m-link">
                                Keenthemes
                            </a>
                        </span>
                    </div>
                    <div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
                        <ul class="m-footer__nav m-nav m-nav--inline m--pull-right">
                            <li class="m-nav__item">
                                <a href="#" class="m-nav__link">
                                    <span class="m-nav__link-text">
                                        About
                                    </span>
                                </a>
                            </li>
                            <li class="m-nav__item">
                                <a href="#"  class="m-nav__link">
                                    <span class="m-nav__link-text">
                                        Privacy
                                    </span>
                                </a>
                            </li>
                            <li class="m-nav__item">
                                <a href="#" class="m-nav__link">
                                    <span class="m-nav__link-text">
                                        T&C
                                    </span>
                                </a>
                            </li>
                            <li class="m-nav__item">
                                <a href="#" class="m-nav__link">
                                    <span class="m-nav__link-text">
                                        Purchase
                                    </span>
                                </a>
                            </li>
                            <li class="m-nav__item">
                                <a href="#" class="m-nav__link" data-toggle="m-tooltip" title="Support Center" data-placement="left">
                                    <i class="m-nav__link-icon flaticon-info m--icon-font-size-lg3"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
import JetApplicationMark from '@/Jetstream/ApplicationMark'
import JetDropdown from '@/Jetstream/Dropdown'
import JetDropdownLink from '@/Jetstream/DropdownLink'
import JetNavLink from '@/Jetstream/NavLink'
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'

export default {
    data () {
        return {
            options:{
                height:'100%',
                size:2
            }
        }
    },
    components: {
        JetApplicationMark,
        JetDropdown,
        JetDropdownLink,
        JetNavLink,
        JetResponsiveNavLink,
    }
}
</script>