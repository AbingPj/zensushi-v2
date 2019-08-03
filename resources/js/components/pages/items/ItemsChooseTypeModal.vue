<template>
  <!-- Modal -->
  <div class="modal fade" id="chooseItemTypeModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
           <div class="text-center"> <h5>Choose Item Type</h5></div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container">

            <div class="row">
              <div class="col mx-auto">
                <button class="btn btn-primary">Raw</button>
              </div>
              <div class="col">
                <button class="btn btn-primary">Product</button>
              </div>
              <div class="col">
                <button class="btn btn-primary">Other</button>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer"></div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
       selectedItemType: {},
       
    }
  },
  methods: {
    
  },
};
</script>
