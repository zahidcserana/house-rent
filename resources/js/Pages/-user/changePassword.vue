<template>
    <app-layout>
        <changePassword :param="param">
            <template #header>
                <Alert
                    :title="title"
                    :flash="flash"
                    :errors="errors"
                    :link="link"
                    :label="label"
                />
            </template>
        </changePassword>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import changePassword from './components/changePassword'
import Alert from '@/Pages/Component/Alert'
export default {
    components: {
        AppLayout,
        changePassword,
        Alert
    },
    props: ['param', 'errors', 'flash'],
    data () {
        return {
            title: 'Change Password',
            link: 'users.index',
            label: 'User List'
        }
    }
}
</script>
