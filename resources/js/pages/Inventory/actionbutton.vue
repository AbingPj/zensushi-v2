<template>
    <div class="btn-group btn-sm" role="group" aria-label="Button group with nested dropdown">
        <div class="btn-group" role="group">
            <button
                id="btnGroupDrop1"
                type="button"
                class="btn btn-sm btn-secondary dropdown-toggle"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
            >Action</button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <a @click="itemIn(item)" class="dropdown-item">
                    <div v-if="item.item_type_id == 2">
                        <i class="fas fa-cubes"></i>
                        &nbsp;PRODUCTION
                    </div>
                    <div v-else>
                        <i class="fas fa-sign-in-alt"></i>
                        &nbsp;IN
                    </div>
                    <!-- <i class="fa fa-check-square-o" aria-hidden="true"></i>
                    &nbsp; {{item.item_type_id == 2? 'PRODUCTION': 'IN'}}-->
                </a>

                <a @click="itemOut(item)" class="dropdown-item">
                    <div v-if="item.item_type_id == 1">
                        <i class="fas fa-cubes"></i>
                        &nbsp;PRODUCTION
                    </div>
                    <div v-else>
                        <i class="fas fa-sign-out-alt"></i>
                        &nbsp;OUT
                    </div>
                    <!-- <i class="fa fa-minus-square" aria-hidden="true"></i>
                    &nbsp;{{item.item_type_id == 1? 'PRODUCTION': 'OUT'}}-->
                </a>
                <a @click=" itemAdditional(item)" class="dropdown-item">
                    <i class="fa fa-plus" aria-hidden="true"></i> &nbsp; Additional
                </a>
            </div>
        </div>
        <button
            @click="editAction(item)"
            type="button"
            class="btn btn-sm btn-info"
            data-toggle="modal"
            data-target="#updateItemModal"
        >
            <i class="fa fa-edit fa-lg"></i>
        </button>
        <button
            @click="deleteAction( item)"
            type="button"
            class="btn btn-sm btn-danger"
            data-toggle="modal"
            data-target="#deleteItemModal"
        >
            <i class="fa fa-trash fa-lg"></i>
        </button>


    </div>
</template>

<script>
export default {
    props: {
        item: Object,
        index: Number
    },

    methods: {
        editAction(data) {
            let dataToUpdate = { ...data };
            this.$events.fire("showItemUpdateModal", dataToUpdate);
        },

        itemIn(data) {
            let dataToIn = { ...data };

            if (dataToIn.item_type_id == 1 || dataToIn.item_type_id == 3) {
                this.$events.fire("showItemInModal", data);
                //  $("#itemInModal").modal("show");
            } else {
                console.log(data);
                LoadingOverlay();
                // window.location = "/zensushi-production/" + data.product_raw_item_id +"/"+ data.id;
                window.location =
                    "/zen/production/" +
                    data.raw_product.raw_id +
                    "/" +
                    data.id;
            }
        },

        itemAdditional(data) {
            this.$events.fire("showItemAdditonalModal", data);

        },

        itemOut(data) {
            if (data.item_type_id == 2 || data.item_type_id == 3) {
                this.$events.fire("showItemOutModal", data);
            } else {
                console.log(data);
                LoadingOverlay();
                // let link = "/zensushi-production/" + data.id;
                // this.$events.fire("showItemRawOutModal", link, dataToOut);
                // window.location = "/zensushi-production/" + data.id;
                window.location = "/zen/production/" + data.id;
            }
        },
        deleteAction(data) {
            let dataToDelete = { ...data };
            this.$events.fire("showItemDeleteModal", dataToDelete);
        }
    }
};
</script>
