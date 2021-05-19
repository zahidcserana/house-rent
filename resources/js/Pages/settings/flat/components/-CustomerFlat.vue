<template>
    <div class="modal fade" id="m_modal_3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        The rented Flat list of this customer
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            &times;
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <div v-for="row in customerFlats" :key="row.id">
                        <h5>
                            Flat No: {{ row.name }}
                        </h5>
                        <p>
                            <b>House Name:</b> {{ row.house.name }}
                        </p>
                        <hr>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
  name: 'CustomerFlat',
    components: {
    },
    props: ['modalOpen', 'customerFlats'],
    data () {
        return {
        }
    },
    created () {
        console.log(this.modalOpen)
        $('#m_modal_3').modal('show')

        if (this.modalOpen) {
            $('body').removeClass('m-page--loading-enabled')

            $('#m_modal_3').modal('show')
        }
    },
    computed: {
    },
    methods: {
        openModel() {
            $('body').removeClass('m-page--loading-enabled')

            $('#m_modal_3').modal('show')
        }
    }
}
</script>
