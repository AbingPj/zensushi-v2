<template>
    <div>
        <div class="modal fade" id="itemOutModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Item Stock-out</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" v-model="date" />
                            </div>

                            <div class="form-group">
                                <label for="title">Stock-out: {{ item.description }}</label>
                                <div class="input-group">
                                    <input
                                        type="number"
                                        class="form-control"
                                        placeholder="0"
                                        v-model="outStock"
                                    />
                                    <div class="input-group-append">
                                        <span class="input-group-text">{{ item.unit.description }}</span>
                                    </div>
                                </div>
                                <br />
                                <div class="text-center">
                                    <button @click="stockOut()" class="btn btn-info">Stock-Out</button>
                                </div>
                            </div>
                        </form>
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
        prop_item: Object
    },
    data() {
        return {
            item: this.prop_item,
            outStock: null,
            date: null
        };
    },
    methods: {
        stockOut() {
            this.axiosPost();
        },

        axiosPost() {
            if (this.item.balance == 0 || this.outStock > this.item.balance) {
                alert(
                    "Item balance must not be zero or item out value must not be greater than item balance."
                );
            } else {
                LoadingOverlay();
                axios
                    .post("/items/stockout", {
                        itemId: this.item.id,
                        value: this.outStock,
                        date: this.date
                    })
                    .then(res => {
                        $("#itemOutModal").modal("hide");
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
        }
    },

    created() {
        this.$events.listen(
            "showItemOutModal",
            data => ($("#itemOutModal").modal("show"), (this.item = data))
        );
    },

    mounted() {
        let self = this;
        $("#itemOutModal").on("hidden.bs.modal", function() {
            //  window.clearTimeout(timer);
            self.outStock = null;
            self.date = null;
        });
    }
    // mounted() {
    //   $("#itemOutModal").on("show.bs.modal	", function(e) {
    //     this.outStock = 0;
    //   });
    // }
};
</script>
