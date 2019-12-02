<template>
  <th v-if="isHeader" class="vuetable-th-component-buttons" v-html="title"></th>
  <td v-else class="vuetable-td-component-buttons">
    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
      <button
        @click="editAction(rowData, rowIndex)"
        type="button"
        class="btn btn-info"
        data-toggle="modal"
        data-target="#updateItemModal"
      >
        <i class="fa fa-edit fa-lg"></i>
      </button>
      <button
        @click="deleteAction( rowData, rowIndex)"
        type="button"
        class="btn btn-danger"
        data-toggle="modal"
        data-target="#deleteItemModal"
      >
        <i class="fa fa-trash fa-lg"></i>
      </button>

      <div class="btn-group" role="group">
        <button
          id="btnGroupDrop1"
          type="button"
          class="btn btn-secondary dropdown-toggle"
          data-toggle="dropdown"
          aria-haspopup="true"
          aria-expanded="false"
        >Action</button>
        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
          <!-- <a class="dropdown-item" href="#"><i class="fa fa-window-close-o" aria-hidden="true"></i> &nbsp;  IN</a> -->
          <a @click="itemIn(rowData)" class="dropdown-item">
            <i class="fa fa-check-square-o fa-2x" aria-hidden="true"></i> &nbsp; {{rowData.item_type_id == 2? 'PRODUCTION': 'IN'}}
          </a>

          <a @click="itemOut(rowData)" class="dropdown-item" href="#">
            <i class="fa fa-minus-square fa-2x" aria-hidden="true"></i> &nbsp;{{rowData.item_type_id == 1? 'PRODUCTION': 'OUT'}}
          </a>
          <a @click=" itemAdditional(rowData)" class="dropdown-item" href="#">
            <i class="fa fa-plus fa-lg" aria-hidden="true"></i> &nbsp; Additional
          </a>
        </div>
      </div>
    </div>

    <!-- <button
      class="btn btn-info btn-sm"
      @click="editAction(rowData, rowIndex) "
      data-toggle="modal"
      data-target="#updatePostModal"
    >
      <i class="fa fa-edit"></i>
    </button>
    <button
      class="btn btn-danger btn-sm"
      @click="deleteAction( rowData, rowIndex)"
      data-toggle="modal"
      data-target="#deletePostModal"
    >
      <i class="fa fa-trash"></i>
    </button>-->
  </td>
</template>
<script>
import VuetableFieldMixin from "vuetable-2/src/components/VuetableFieldMixin.vue";

export default {
  name: "vuetable-field-buttons",
  mixins: [VuetableFieldMixin],

  methods: {
    editAction(data, index) {
      let dataToUpdate = { ...data };
      // let dataToUpdate = data;
      this.$events.fire("showItemUpdateModal", dataToUpdate);
    },

    itemIn(data) {
      let dataToIn = { ...data };

      if (dataToIn.item_type_id == 1 || dataToIn.item_type_id == 3) {
        this.$events.fire("showItemInModal", dataToIn);
      }else{
        console.log(data);
        LoadingOverlay();
        window.location = "/zensushi-production/" + data.product_raw_item_id +"/"+ data.id;
      }

      
    },

    itemAdditional(data){
      let dataToAdditional = { ...data };
       this.$events.fire("showItemAdditionalModal", dataToAdditional);
    },

    itemOut(data) {
      let dataToOut = { ...data };
      if (dataToOut.item_type_id == 2 || dataToOut.item_type_id == 3) {
        this.$events.fire("showItemOutModal", dataToOut);
      }else{
         console.log(data);
        LoadingOverlay();
        let link = "/zensushi-production/" + data.id;
         this.$events.fire("showItemRawOutModal", link, dataToOut);
        // window.location = ;
      }
    },
    deleteAction(data, index) {
      let dataToDelete = { ...data };
      this.$events.fire("showItemDeleteModal", dataToDelete);
    }
  }
};
</script>