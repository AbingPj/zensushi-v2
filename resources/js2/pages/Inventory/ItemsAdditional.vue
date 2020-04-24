<template>
    <div>
        <div class="modal fade" id="itemAdditionalModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Item Additional</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" v-model="date" />
                        </div>

                        <div class="form-group">
                            <label for="title">Additional: {{ item.description }}</label>
                            <div class="input-group">
                                <input
                                    type="number"
                                    class="form-control"
                                    placeholder="0"
                                    v-model="additional"
                                />
                                <div class="input-group-append">
                                    <span class="input-group-text">{{ item.unit.description }}</span>
                                </div>
                            </div>

                            <br />
                            <div class="text-center">
                                <button @click="additionalItem()" class="btn btn-info">Additional</button>
                            </div>
                        </div>
                        <!-- <div class="modal-footer">
                <button class="btn btn-info" data-dismiss="modal">IN</button>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        item: Object
    },
    data() {
        return {
            additional: null,
            date: null
        };
    },
    methods: {
        additionalItem() {
            this.axiosPost();
        },
        axiosPost() {
            LoadingOverlay();
            axios
                .post("/items/additional", {
                    itemId: this.item.id,
                    value: this.additional,
                    date: this.date
                })
                .then(res => {
                    $("#itemAdditionalModal").modal("hide");
                })
                .catch(err => {
                    alert(
                        "This function have an error, please contact the zensushi developer. \n" +
                            "Error: [" +
                            err.message +
                            " \n " +
                            err.response.data.message +
                            "]"
                    );
                    LoadingOverlayHide();
                });
        }
    },

    mounted() {
        let self = this;
        $("#itemAdditionalModal").on("hidden.bs.modal", function() {
            self.additional = null;
            self.date = null;
        });
    }
};
</script>
