<template>
    <div class="row">
        <div class="col-6 m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        {{ title ? title : 'House Rent' }}
                    </h3>
                </div>
            </div>
            <div
                v-if="flash && flash.message"
                :type="flash.message | success"
            ></div>
            <div v-if="Object.keys(errors).length" :type="errors | error"></div>
        </div>
        <div class="col-6">
            <jet-responsive-nav-link
                :href="route(link)"
                :active="route().current(link)"
                class="btn btn-success m-btn m-btn--icon m-btn--pill m-btn--ai side-button"
            >
                <i class="la la-angle-double-left" aria-hidden="true"></i>
                <span> &nbsp; {{ label }} </span>
            </jet-responsive-nav-link>
        </div>
    </div>
</template>

<script>
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'
import swal from 'sweetalert2'
window.Swal = swal

export default {
    components: {
        JetResponsiveNavLink
    },
    props: ['errors', 'title', 'flash', 'link', 'label'],
    filters: {
        success (status) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: toast => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: status
            })
        },
        error (errors) {
            let list = []
            $.each(errors, function (key, value) {
                list.push(value)
            })

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: list[0],
                showConfirmButton: false,
                timer: 1500
            })
        }
    }
}
</script>

<style>
.side-button {
    right: 5%;
    position: absolute;
    top: 20%;
}
</style>
