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
                                                    <label>Name</label>
                                                    <input class="form-control" type="text" v-model="form.name" />
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input :disabled="editMode == true" class="form-control" type="text" v-model="form.email" />
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Mobile</label>
                                                    <input class="form-control" type="text" v-model="form.mobile" />
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Role <span class="text-red">*</span></label>
                                                    <select class="form-control select"  v-model="form.role_id">
                                                        <option value="" selected>--Select Role--</option>
                                                        <option  v-for="(row, index) in param.roles" :key="index" :value="row.id">{{ row.name }} :&nbsp; {{ row.description }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6" v-if="!form.id">
                                                <div class="form-group">
                                                    <label>Password <span class="text-red">*</span></label>
                                                    <input
                                                        class="form-control"
                                                        type="password"
                                                        v-model="form.password"
                                                    />
                                                </div>
                                            </div>
                                            <div class="col-sm-6" v-if="!form.id">
                                                <div class="form-group">
                                                    <label>Confirm Password <span class="text-red">*</span></label>
                                                    <input
                                                        class="form-control"
                                                        type="password"
                                                        v-model="form.password_confirmation"
                                                    />
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <br />
                                                    <div class="form-check form-check-inline">
                                                        <input v-model="form.status" class="form-check-input" type="radio" name="status" value="active" />
                                                        <label class="form-check-label" for="product_active" >Active</label>
                                                    </div>
                                                    <div class="form-check form-check-inline" >
                                                        <input v-model=" form.status" class="form-check-input" type="radio" name="status" value="inactive"/>
                                                        <label class="form-check-label" for="product_inactive">Inactive</label>
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
export default {
    components: {
        Alert
    },
    props: ['param', 'editMode'],
    data () {
        return {
            form: {
                id: undefined,
                name: null,
                email: null,
                mobile: null,
                status: 'active'
            }
        }
    },
    created () {
        if (this.editMode) {
            this.form.id = this.param.data.id
            this.form.name = this.param.data.name
            this.form.email = this.param.data.email
            this.form.mobile = this.param.data.mobile
            this.form.status = this.param.data.status
            this.form.role_id = this.param.data.role_id
        }
    },
    methods: {
        reset: function () {
            this.form = {
                name: null,
                email: null,
                mobile: null,
                status: 'active'
            }
        },
        save: function (data) {
            this.$inertia.post('/user', data)
            this.reset()
        },
        update: function (data) {
            data._method = 'PUT'
            this.$inertia.post('/user/' + data.id, data)
        }
    }
}
</script>
