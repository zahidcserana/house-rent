<template>
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <div class="m-content">
            <div class="row">
                <div class="col-xl-12">
                    <!--begin::Portlet-->
                    <div class="m-portlet">

                        <slot name="header"></slot>

                        <div class="m-portlet__body">
                            <!--begin::Section-->
                            <div class="m-section">
                                <div class="m-section__content">
                                    <table class="table table-striped m-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="row in param.data" :key="row.id">
                                                <td>{{ row.id }}</td>
                                                <td>
                                                    <jet-responsive-nav-link :href="row.link_edit">
                                                        {{ row.name }}
                                                    </jet-responsive-nav-link>
                                                </td>
                                                <td>{{ row.description }}</td>
                                                <td><span class="custom-badge" v-bind:class="row.status == 'ACTIVE' ? 'status-green' : 'status-red'">{{ row.status }}</span></td>

                                                <td class="text-right">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <jet-responsive-nav-link :href="row.link_edit" class="dropdown-item">
                                                                <i class="fa fa-pencil m-r-5"></i>&nbsp; Edit
                                                            </jet-responsive-nav-link>
                                                            <a class="dropdown-item" href="#" data-toggle="modal" @click="deleteRow(row)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--end::Section-->
                        </div>
                        <!--end::Form-->
                    </div>
                    <!--end::Portlet-->
                </div>
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
    props: ['param'],
    methods: {
        deleteRow: function (data) {
            if (!confirm('Are you sure want to remove?')) return
            data._method = 'DELETE'
            this.$inertia.post(data.link_delete.url, data)
        }
    }
}
</script>

<style>
.pl-3, .px-3 {
    padding-left: 0!important;
}
</style>