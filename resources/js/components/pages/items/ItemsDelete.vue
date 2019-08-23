<template>
  <div>
    <div class="modal fade" id="deleteItemModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Delete Item</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <p>
              Are you sure you want to delete this item:
              <br />Item:&nbsp;[ &nbsp;
              <b>{{ item.description }}</b> &nbsp;] ?
            </p>
            <center>
              <button @click="deleteItem()" class="btn btn-danger" data-dismiss="modal">Yes</button>
              <button class="btn btn-secondary" data-dismiss="modal">No</button>
            </center>
          </div>

          <!-- Modal footer -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      item: []
    };
  },
  methods: {
    async deleteItem() {
      LoadingOverlay();
      let { status } = await axios.delete("/items/delete/" + this.item.id);
      if (status == 200) {
        this.$events.fire("refreshItemsVueTable", status);
        LoadingOverlayHide();
      }
    },
    setItem(data) {
      console.log(data);
      this.item = data;
    }
  },

  created() {
    this.$events.listen("showItemDeleteModal", data => this.setItem(data));
  }
};
</script>