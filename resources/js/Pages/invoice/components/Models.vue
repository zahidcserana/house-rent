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
                                <form id="filter-form">
                                    <div class="row filter-row">
                                        <div v-if="param.customers" class="col-sm-6 col-md-3">
                                            <div class="form-group form-focus">
                                                <select class="form-control select"  v-model="query.customer_id">
                                                    <option value="" selected>-- Customer --</option>
                                                    <option  v-for="(row,index) in param.customers" :key="index" :value="row.id">{{ row.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div v-if="param.status" class="col-sm-2 col-md-2">
                                            <div class="form-group form-focus">
                                                <select class="form-control select mb-2 mr-sm-2"  v-model="query.status">
                                                    <option value="all" selected>--- all ---</option>
                                                    <option  v-for="(value, key, index) in param.status" :key="index" :value="key">{{value }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-md-2">
                                            <button
                                                type="button"
                                                @click="getData()"
                                                class="btn btn-success btn-block"
                                            >
                                                Search
                                            </button>
                                        </div>
                                        <div class="col-sm-3 col-md-2">
                                            <button type="button" @click="resetData()" class="btn btn-warning btn-block"> Reset </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="m-section">
                                <div class="m-section__content">
                                    <table class="table table-striped m-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Month</th>
                                                <th>Renter</th>
                                                <th>Total</th>
                                                <th>Additional Cost</th>
                                                <th>Payable Amount</th>
                                                <th>Paid Amount</th>
                                                <th>Due Amount</th>
                                                <th>Status</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="row in param.data.data" :key="row.id">
                                                <td>
                                                    <jet-responsive-nav-link :href="row.link_edit">
                                                        {{ row.invoice_no }}
                                                    </jet-responsive-nav-link>
                                                </td>
                                                <td>{{ row.date | formatDate }}</td>
                                                <td>
                                                    <jet-responsive-nav-link :href="row.customer.url">
                                                        <span class="m-menu__link-text">{{ row.customer.name }}</span>
                                                    </jet-responsive-nav-link>
                                                </td>
                                                <td>{{ row.total }}</td>
                                                <td>{{ row.additional_cost }}</td>
                                                <td>{{ row.payable_amount }}</td>
                                                <td>{{ row.paid_amount }}</td>
                                                <td>{{ row.due_amount }}</td>
                                                <td>
                                                    <span class="m-badge m-badge--wide" v-bind:class="row.status | statusMap">{{ param.status[row.status] }}</span>
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
    </div>
</template>

<script>
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'
import ServiceModel from './ServiceModel'

export default {
    components: {
        JetResponsiveNavLink
    },
    props: ['param'],
    data () {
        return {
            customers: null,
            query: ServiceModel.search
        }
    },
    mounted () {
        if (!_.isEmpty(this.param.query)) {
            this.query = this.param.query
        }

        if (this.param.query.length === 0) {
            this.resetQuery()
        }
    },
    methods: {
        resetQuery: function () {
            this.query = {
                customer_id: '',
                status: 'unpaid',
            }
        },
        getData: function () {
            this.$inertia.get('/invoice', this.query)
        },
        resetData: function () {
            this.resetQuery()
            this.$inertia.get('/invoice')
        },
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