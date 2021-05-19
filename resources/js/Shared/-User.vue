<template>
    <div class="form-group">
        <label class="typo__label" for="ajax">Medicine</label>
        <multiselect v-model="form.user_id" id="ajax" label="name" track-by="name" placeholder="Type to search" open-direction="bottom" :options="users" :custom-label="CustomLabel" :searchable="true" :loading="isLoading" @search-change="searchUser"></multiselect>
    </div>
</template>

<script>
import {HTTP} from '@/utils/http-common'

export default {
    data () {
        return {
            users: [],
            search: { term: ''},
            isLoading: false
        }
    },
    components: {
    },
    methods: {
        CustomLabel ({ name, mobile }) {
            return `${name} — (${mobile})`
        },
        searchUser (query) {
            this.isLoading = true
            this.search.term = query
            HTTP.post('/search-user', this.search).then(response => {
                this.users = response.data
                this.isLoading = false
            })
        }
    }
}
</script>