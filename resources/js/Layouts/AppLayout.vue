<template>
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <Header />

        <!-- Page Heading -->
        <!-- <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <slot name="header"></slot>
            </div>
        </header> -->

        <!-- Page Content -->
        <main>
			<div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver-desktop m-grid--desktop m-page__container m-body">
                <slot></slot>
			</div>
        </main>

        <!-- Modal Portal -->
        <portal-target name="modal" multiple>
        </portal-target>

        <Footer />
    </div>
</template>

<script>
    import JetApplicationMark from '@/Jetstream/ApplicationMark'
    import JetDropdown from '@/Jetstream/Dropdown'
    import JetDropdownLink from '@/Jetstream/DropdownLink'
    import JetNavLink from '@/Jetstream/NavLink'
    import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'
    import Header from '@/Layouts/Header'
    import Footer from '@/Layouts/Footer'

    export default {
        components: {
            JetApplicationMark,
            JetDropdown,
            JetDropdownLink,
            JetNavLink,
            JetResponsiveNavLink,
            Header,
            Footer
        },
        data() {
            return {
                showingNavigationDropdown: false,
            }
        },
        mounted () {
            const plugin = document.createElement('script')
            plugin.setAttribute('src', 'assets/demo/demo8/base/scripts.bundle.js')
            plugin.async = true
            document.head.appendChild(plugin)

            setTimeout(this.showPage, 500)
        }
    }
</script>
