<template>
   <div class="container">
      <div class="row">
         <div class="col-md-5">
            <h3>Select Products</h3>
            <small>Select product to make request delivery list</small>
            <div class="input-group mb-3">
               <input type="text" class="form-control" placeholder="Searh Products here" />
               <div class="input-group-append">
                  <button class="btn btn-primary" type="button">Search</button>
               </div>
            </div>
            <table class="table table-striped">
               <thead>
                  <th>id</th>
                  <th>Item Name</th>
                  <th>Remaing Quantity(In Production)</th>
                  <th>Select</th>
               </thead>
               <tbody>
                  <td>1</td>
                  <td>Pork Chops</td>
                  <td>500 pack</td>
                  <td>
                     <button class="btn btn-success btn-sm">Select</button>
                  </td>
               </tbody>
            </table>
         </div>

         <div class="col-md-7">
             <h3 class="text-center">Delivery Reqquest Form</h3>

         </div>
      </div>
   </div>
</template>