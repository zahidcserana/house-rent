<template>
    <div class="hospital-create">
        <slot name="header"></slot>

        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <form>
                        <div class="row">

                            <div class="col-lg-8 offset-lg-2">
                                    <div class="form-group">
                                        <label>Current Password <span class="text-red">*</span></label>
                                        <input
                                            class="form-control"
                                            type="password"
                                            v-model="form.old_password"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label>New Password <span class="text-red">*</span></label>
                                        <input
                                            class="form-control"
                                            type="password"
                                            v-model="form.new_password"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password <span class="text-red">*</span></label>
                                        <input
                                            class="form-control"
                                            type="password"
                                            v-model="form.confirm_password"
                                        />
                                    </div>
                            </div>

                        </div>



                        <div class="m-t-20 text-center">
                            <button
                                type="button"
                                class="btn btn-primary submit-btn"
                                wire:click.prevent="store()"
                                :disabled="form.new_password == '' || form.new_password != form.confirm_password"
                                @click="update(form)"
                            >
                                Save
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
            form: {
                id: undefined,
                old_password: '',
                new_password: '',
                confirm_password: '',
            }
        }
    },
    mounted () {

    },
    methods: {
        update: function (data) {
            this.$inertia.post('/updatePassword', data)
        }
    }
}
</script>
