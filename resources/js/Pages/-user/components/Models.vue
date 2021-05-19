<template>
     <div class="hospital-list">
        <slot name="header"></slot>

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-border table-striped custom-table datatable mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="row in param.data" :key="row.id">
                                <td>{{ row.id }}</td>
                                <td>{{ row.name }}</td>
                                <td>{{ row.email }}</td>
                                <td>{{ row.role.name }}</td>
                                <td><span class="custom-badge" v-bind:class="row.status == 'ACTIVE' ? 'status-green' : 'status-red'">{{ row.status }}</span></td>

                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                             <jet-responsive-nav-link :href="route('users.edit', [row.id])" :active="route().current('users.create')" class="dropdown-item">
                                                <i class="fa fa-pencil m-r-5"></i>Edit
                                            </jet-responsive-nav-link>
                                            <a v-if="$page.isAdmin" class="dropdown-item" href="#" data-toggle="modal" @click="deleteRow(row)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
            if (!confirm('Are you sure want to remove?')) return;
            data._method = 'DELETE';
            this.$inertia.post('/roles/' + data.id, data)
        }
    }
}
</script>
