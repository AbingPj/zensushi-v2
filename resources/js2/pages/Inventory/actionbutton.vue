<template>
    <div class="btn-group btn-sm" role="group" aria-label="Button group with nested dropdown">
        <button
            @click="editAction(rowData, rowIndex)"
            type="button"
            class="btn btn-sm btn-info"
            data-toggle="modal"
            data-target="#updateItemModal"
        >
            <i class="fa fa-edit fa-lg"></i>
        </button>
        <button
            @click="deleteAction( rowData, rowIndex)"
            type="button"
            class="btn btn-sm btn-danger"
            data-toggle="modal"
            data-target="#deleteItemModal"
        >
            <i class="fa fa-trash fa-lg"></i>
        </button>

        <div class="btn-group" role="group">
            <button
                id="btnGroupDrop1"
                type="button"
                class="btn btn-sm btn-secondary dropdown-toggle"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
            ></button>
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
    </div>
</template>

<script>
export default {
    props: {
        item: Object
    },

    methods: {
        itemIn(data) {
            console.log(data);
        },
        itemOut(data) {
            console.log(data);
        },
        itemAdditional(data) {
            console.log(data);
        }
    }
};
</script>
