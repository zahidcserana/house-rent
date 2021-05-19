<template>
    <app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Model :param="param" :errors="errors">
                        <template #header>
                            <Alert
                                :title="title"
                                :flash="flash"
                                :errors="errors"
                                :link="link"
                                :label="label"
                            />
                        </template>
                    </Model>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Model from './components/Model'
import Alert from '@/Pages/Component/Alert'
export default {
    components: {
        AppLayout,
        Model,
        Alert
    },
    props: ['param', 'errors', 'flash'],
    data () {
        return {
            title: 'New Flat',
            link: 'flat.index',
            label: 'Flat List'
        }
    }
}
</script>
