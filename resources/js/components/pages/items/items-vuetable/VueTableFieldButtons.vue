<template>
  <th v-if="isHeader" class="vuetable-th-component-buttons" v-html="title"></th>
  <td v-else class="vuetable-td-component-buttons">
    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
      <button @click="editAction(rowData, rowIndex)" type="button" class="btn btn-info">
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
          <a class="dropdown-item" href="#">
            <i class="fa fa-check-square-o fa-2x" aria-hidden="true"></i> &nbsp; IN
          </a>

          <a class="dropdown-item" href="#">
            <i class="fa fa-minus-square fa-2x" aria-hidden="true"></i> &nbsp;OUT
          </a>
          <a class="dropdown-item" href="#">
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
import $ from "jquery";
import VuetableFieldMixin from "vuetable-2/src/components/VuetableFieldMixin.vue";

export default {
  name: "vuetable-field-buttons",
  mixins: [VuetableFieldMixin],

  methods: {
    editAction(data, index) {
      this.$events.fire("show-update-modal", data);
    },
    deleteAction(data, index) {
      this.$events.fire("showItemDeleteModal", data);
    }
  }
};
</script>