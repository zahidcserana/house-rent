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
                                    <form>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Flat Name</label>
                                                    <input class="form-control" v-model="form.name"/>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>House</label>
                                                    <v-select
                                                        v-model="form.house_id"
                                                        :options="param.houses"
                                                        :reduce="option => option.id"
                                                        placeholder="-Select-"
                                                    />
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Rental Amount</label>
                                                    <input class="form-control" min="0" v-model="form.rent"/>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Customer</label>
                                                    <v-select
                                                        v-model="form.customer_id"
                                                        :options="param.customers"
                                                        :reduce="option => option.id"
                                                        placeholder="Select Customer"
                                                        @input="customerFlat"
                                                    />
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <br />
                                                    <div v-for="(value, key, index) in param.status" :key="index" :value="key" class="form-check form-check-inline">
                                                        <input v-model="form.status" class="form-check-input" type="radio" name="status" :value="key" />
                                                        <label class="form-check-label" for="product_active" > {{ value }} </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="m-t-20 text-center">
                                            <button
                                                type="button"
                                                class="btn btn-primary submit-btn"
                                                wire:click.prevent="store()"
                                                v-show="!editMode"
                                                @click="save(form)"
                                            >
                                                Save
                                            </button>
                                            <button
                                                type="button"
                                                class="btn btn-primary submit-btn"
                                                wire:click.prevent="store()"
                                                v-show="editMode"
                                                @click="update(form)"
                                            >
                                                Update
                                            </button>
                                        </div>
                                    </form>
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
                            The rented flat list of this customer
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
import Alert from '@/Pages/Component/Alert'

export default {
    components: {
        Alert
    },
    props: ['param', 'editMode'],
    data () {
        return {
            customerFlats: [],
            totalRent: 0,
            form: {
                id: undefined,
                name: null,
                rent: null,
                house_id: '',
                customer_id: '',
                status: 'available'
            }
        }
    },
    created () {
        if (this.editMode) {
            this.form = this.param.data
        }
    },
    computed: {
    },
    methods: {
        reset: function () {
            this.form = {
                name: null,
                rent: null,
                status: 'available'
            }
        },
        save: function (data) {
            this.$inertia.post('/flat', data)
            this.reset()
        },
        update: function (data) {
            data._method = 'PUT'
            this.$inertia.post('/flat/' + data.id, data)
        },
        customerFlat(customerId) {
            this.form.status = 'rented'
            axios.get('/customer/flat/' + customerId)
                .then(res => {
                    if (res.data.data.length > 0) {
                        $('body').removeClass('m-page--loading-enabled')
                        this.customerFlats = res.data.data
                        this.totalRent = 0

                        this.customerFlats.forEach(element => {
                            this.totalRent += parseFloat(element.rent)
                        });
                        $('#m_modal_3').modal('show')
                    }
                }).catch(err => {
                console.log(err)
            })
        },
    }
}
</script>
