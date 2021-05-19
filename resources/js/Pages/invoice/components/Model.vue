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
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label><b>Customer Name</b></label>: {{ param.data.customer.name }}
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label><b>Month</b></label>: {{ param.data.date | formatDate }}
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label><b>Status:</b></label>
                                                    &nbsp;
                                                    <div class="form-check form-check-inline">
                                                        <input v-model="form.status" class="form-check-input" type="radio" name="status" value="unpaid" />
                                                        <label class="form-check-label" for="" > Unpaid </label>
                                                    </div>
                                                    <div class="form-check form-check-inline" >
                                                        <input v-model=" form.status" class="form-check-input" type="radio" name="status" value="paid"/>
                                                        <label class="form-check-label" for="">Paid </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input v-model="form.status" class="form-check-input" type="radio" name="status" value="cancel" />
                                                        <label class="form-check-label" for=""> Cancel </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 invoice-table">
                                                <div class="row div-header" v-if="param.data.invoice_items">
                                                    <div class="col-md-4">#</div>
                                                    <div class="col-md-4">Flat</div>
                                                    <div class="col-md-4">Rent</div>
                                                </div>
                                                <div v-for="(row,index) in param.data.invoice_items" :key="index" :class="[index%2==0? 'row':'odd-row row']">
                                                    <div class="col-md-4">{{ index + 1 }}</div>
                                                    <div class="col-md-4">{{ row.flat.name }}</div>
                                                    <div class="col-md-4">{{ row.rent }}</div>
                                                </div>
                                                <div class="row div-footer">
                                                    <div class="col-md-4">&nbsp;</div>
                                                    <div class="col-md-4">Total</div>
                                                    <div class="col-md-4">{{ param.data.total }}</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 summary-div-row">
                                                <div class="row summary-row">
                                                    <div class="summary-div">
                                                        <label class="title-div">Rent Amount</label>
                                                        <span class="text-div">{{ param.data.total }}</span>
                                                    </div>
                                                    <div class="summary-div">
                                                        <label class="title-div">Additional Amount</label>
                                                        <input min="0" type="number" class="text-div form-control" v-model="form.additional_cost" @keyup="getTotal"/>
                                                    </div>
                                                    <div class="summary-div">
                                                        <label class="title-div">Total Amount</label>
                                                        <span class="text-div">{{ total }}</span>
                                                    </div>
                                                    <div class="summary-div">
                                                        <label class="title-div">Paid Amount</label>
                                                        <input min="0" type="number" class="text-div form-control" v-model="form.paid_amount" @keyup="getTotal"/>
                                                    </div>
                                                    <div class="summary-div">
                                                        <label class="title-div">Due Amount</label>
                                                        <span class="text-div">{{ due }}</span>
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
    </div>
</template>

<script>
import Alert from '@/Pages/Component/Alert'
import Label from '../../../Jetstream/Label.vue'

export default {
    components: {
        Alert
    },
    props: ['param', 'editMode'],
    data () {
        return {
            customerFlats: [],
            total: 0.00,
            due: 0.00,
            form: {
                id: undefined,
                additional_cost: 0,
                paid_amount: 0,
                status: 'available'
            }
        }
    },
    created () {
        if (this.editMode) {
            this.form = this.param.data

            this.total = parseFloat(this.param.data.total) + parseFloat(this.param.data.additional_cost)
            this.due = this.total - parseFloat(this.param.data.paid_amount)
        }
    },
    computed: {
    },
    methods: {
        reset: function () {
            this.form = {
                name: null,
                status: 'available'
            }
        },
        save: function (data) {
            this.$inertia.post('/invoice', data)
            this.reset()
        },
        update: function (data) {
            data._method = 'PUT'
            this.$inertia.post('/invoice/' + data.id, data)
        },
        getTotal: function () {
            this.total = parseFloat(this.param.data.total) + parseFloat(this.form.additional_cost > 0 ? this.form.additional_cost : 0)
            this.due = this.total - parseFloat(this.form.paid_amount > 0 ? this.form.paid_amount : 0)
        }
    }
}
</script>

<style>
.div-header {
    font-weight: bold;
    background: #d6c5c5;
}
.div-footer {
    font-weight: bold;
    font-size: 15px;
}
.summary-div {
    width: 100%;
    display: flex;
    padding: 0.3rem 1rem;
}
.title-div {
    flex: 1;
}
.text-div {
    float: right;
    flex: 1;
    font-weight: bold;
}
.summary-row {
    font-size: 15px;
    border: 6px solid #f1dec5;
}
.invoice-table div{
    padding: 3px;
}
.summary-div-row {
    padding-left: 30px;
}
.odd-row{
    background: aliceblue;
}
.text-center {
    text-align: center !important;
    padding-top: 1%;
}
</style>