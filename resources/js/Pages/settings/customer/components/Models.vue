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
                                                <th v-if="$page.isAdmin">Owner</th>
                                                <th>Balance</th>
                                                <th>Status</th>
                                                <th>Flat</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(row,index) in param.data.data" :key="index">
                                                <td>{{ index + 1 }}</td>
                                                <td>
                                                    <jet-responsive-nav-link :href="row.link_edit">
                                                        {{ row.name }}
                                                    </jet-responsive-nav-link>
                                                </td>
                                                <td v-if="$page.isAdmin">
                                                    <jet-responsive-nav-link :href="row.user.url">
                                                        {{ row.user.name }}
                                                    </jet-responsive-nav-link>
                                                </td>
                                                <td>{{ row.account_balance }}</td>
                                                <td><span class="custom-badge" v-bind:class="row.status == 'ACTIVE' ? 'status-green' : 'status-red'">{{ row.status }}</span></td>
                                                <td>
                                                    <button class="btn btn-info" @click="viewFlat(row)">View</button>
                                                </td>
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

        <div class="modal fade" id="m_modal_3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Rented Flat
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                &times;
                            </span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div v-for="row in customerFlats" :key="row.id">
                            <h5>
                                Flat No: {{ row.name }} <span class="float-right">Rent: {{ row.rent }}</span>
                            </h5>
                            <p>
                                <b>House Name:</b> {{ row.house.name }}
                            </p>
                            <hr>
                        </div>
                        <h5><b>Total: </b> <span class="float-right">{{ totalRent | number2Decimal }}</span></h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                    </div>
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
    data() {
        return {
            customerFlats: [],
            totalRent: 0
        }
    },
    methods: {
        deleteRow: function (data) {
            if (!confirm('Are you sure want to remove?')) return
            data._method = 'DELETE'
            this.$inertia.post(data.link_delete.url, data)
        },
        viewFlat: function (data) {
            $('body').removeClass('m-page--loading-enabled')
            this.customerFlats = data.flats

            this.totalRent = 0

            this.customerFlats.forEach(element => {
                this.totalRent += parseFloat(element.rent)
            });

            $('#m_modal_3').modal('show')
        }
    }
}
</script>

<style>
.pl-3, .px-3 {
    padding-left: 0!important;
}
</style>