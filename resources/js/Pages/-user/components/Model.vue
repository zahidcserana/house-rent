<template>
    <div class="hospital-create">
        <slot name="header"></slot>

        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <form>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>User Name <span class="text-red">*</span></label>
                                    <input
                                        class="form-control"
                                        type="text"
                                        v-model="form.name"
                                    />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>User Email <span class="text-red">*</span></label>
                                    <input
                                        class="form-control"
                                        type="text"
                                        v-model="form.email"
                                    />
                                </div>
                            </div>
                            <div class="col-sm-6" v-if="!form.id">
                                <div class="form-group">
                                    <label>Password <span class="text-red">*</span></label>
                                    <input
                                        class="form-control"
                                        type="text"
                                        v-model="form.password"
                                    />
                                </div>
                            </div>
                            <div class="col-sm-6" v-if="!form.id">
                                <div class="form-group">
                                    <label>Confirm Password <span class="text-red">*</span></label>
                                    <input
                                        class="form-control"
                                        type="text"
                                        v-model="form.confirm_password"
                                    />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Hospital</label>
                                    <select class="form-control select"  v-model="form.hospital_id" @change="getDepartment()">
                                        <option value="" selected>--Select Hospital--</option>
                                        <option  v-for="(row,index) in param.hospitals" :key="index" :value="row.id">{{ row.name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div v-if="departments" class="col-sm-6">
                                <div class="form-group">
                                    <label>Department</label>
                                    <select class="form-control select"  v-model="form.department_id">
                                        <option value="" selected>--Select Department--</option>
                                        <option  v-for="(row,index) in departments" :key="index" :value="row.id">{{ row.name }}</option>
                                    </select>
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
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>User Status</label><br />
                                    <div class="form-check form-check-inline">
                                        <input
                                            v-model="form.status"
                                            class="form-check-input"
                                            type="radio"
                                            name="status"
                                            value="ACTIVE"
                                        />
                                        <label
                                            class="form-check-label"
                                            for="product_active"
                                        >
                                            Active
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input
                                            v-model="form.status"
                                            class="form-check-input"
                                            type="radio"
                                            name="status"
                                            value="INACTIVE"
                                        />
                                        <label
                                            class="form-check-label"
                                            for="product_inactive"
                                        >
                                            Inactive
                                        </label>
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
            departments: null,
            form: {
                id: undefined,
                name: null,
                email: null,
                role_id: null,
                hospital_id: null,
                department_id: null,
                status: 'ACTIVE'
            }
        }
    },
    mounted () {
        if (this.editMode) {
            this.form.id = this.param.data.id
            this.form.name = this.param.data.name
            this.form.email = this.param.data.email
            this.form.role_id = this.param.data.role_id
            this.form.hospital_id = this.param.data.hospital_id
            this.form.department_id = this.param.data.department_id
            this.form.status = this.param.data.status

            if (this.form.hospital_id) {
                let stop = false
                this.param.hospitals.forEach(row => {
                    if(stop){ return; }

                    if (row.id == this.form.hospital_id) {
                        this.departments = _.isEmpty(row.departments) ? null : row.departments
                        stop = true;
                    }
                })
            }
        }
    },
    methods: {
        reset: function () {
            this.form = {
                name: null,
                email: null,
                role_id: null,
                status: 'ACTIVE'
            }
        },
        save: function (data) {
            this.$inertia.post('/users', data)
            this.reset()
        },
        update: function (data) {
            data._method = 'PUT'
            this.$inertia.post('/users/' + data.id, data)
        },
        getDepartment: function () {
            let stop = false
            this.param.hospitals.forEach(row => {
                if(stop){ return; }

                if (row.id == this.form.hospital_id) {
                    this.departments = _.isEmpty(row.departments) ? null : row.departments
                     stop = true;
                }
            })
        }
    }
}
</script>
