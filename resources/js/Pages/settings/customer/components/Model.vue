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
                                                    <label>Customer Name</label>
                                                    <input class="form-control" type="text" v-model="form.name" />
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Mobile</label>
                                                    <input class="form-control" type="text" v-model="form.mobile" />
                                                </div>
                                            </div>
                                            <div class="col-sm-6" :class="{'d-none': !$page.isAdmin}">
                                                <user-list @userId="getUserId"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <br />
                                                    <div class="form-check form-check-inline">
                                                        <input v-model="form.status" class="form-check-input" type="radio" name="status" value="ACTIVE" />
                                                        <label class="form-check-label" for="product_active" >ACTIVE</label>
                                                    </div>
                                                    <div class="form-check form-check-inline" >
                                                        <input v-model=" form.status" class="form-check-input" type="radio" name="status" value="INACTIVE"/>
                                                        <label class="form-check-label" for="product_inactive">INACTIVE</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m-t-20 text-center">
                                            <button type="button" class="btn btn-primary submit-btn" wire:click.prevent="store()" v-show="!editMode" @click="save(form)">Save</button>
                                            <button type="button" class="btn btn-primary submit-btn" wire:click.prevent="store()" v-show="editMode" @click="update(form)">Update</button>
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
import UserList from '@/Shared/Form/UserList.vue'

export default {
    components: {
        Alert,
        UserList
    },
    props: ['param', 'editMode'],
    data () {
        return {
            form: {
                id: undefined,
                user_id: null,
                name: null,
                mobile: null,
                status: 'ACTIVE'
            }
        }
    },
    created () {
        if (this.editMode) {
            this.form.id = this.param.data.id
            this.form.name = this.param.data.name
            this.form.mobile = this.param.data.mobile
            this.form.status = this.param.data.status
        }
    },
    methods: {
        reset: function () {
            this.form = {
                name: null,
                status: 'ACTIVE'
            }
        },
        getUserId (data) {
            this.form.user_id = data
        },
        save: function (data) {
            this.$inertia.post('/customer', data)
            this.reset()
        },
        update: function (data) {
            data._method = 'PUT'
            this.$inertia.post('/customer/' + data.id, data)
        }
    }
}
</script>
