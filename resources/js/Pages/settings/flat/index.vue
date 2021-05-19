<template>
    <app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Models :param="param">
                        <template #header>
                            <Alert
                                :title="title"
                                :flash="flash"
                                :errors="errors"
                                :link="link"
                                :label="label"
                            />
                        </template>
                    </Models>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Models from './components/Models'
import Alert from '@/Pages/Component/Alert'

export default {
    components: {
        AppLayout,
        Models,
        Alert
    },
    props: ['param', 'errors', 'flash'],
    data () {
        return {
            title: 'Flat List',
            link: 'flat.create',
            label: 'Create Flat'
        }
    }
}
</script>