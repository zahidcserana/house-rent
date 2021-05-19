<template>
    <div class="form-group">
        <label>User</label>
        <select class="form-control m-input" v-model="user_id" @change="emitData">
            <option v-for="(item,index) in users" :value="item.id" :key="index">{{ item.name }}</option>
        </select>
    </div>
</template>

<script>
import {HTTP} from '@/utils/http-common'

export default {
    data () {
        return {
            users: [],
            user_id: null
        }
    },
    mounted () {
        this.userList()
    },
    methods: {
        userList () {
            HTTP.get('/user-list').then(response => {
                this.users = response.data
                this.user_id = this.users[0].id
                this.emitData()
            })
        },
        emitData () {
            this.$emit('userId', this.user_id)
        }
    }
}
</script>