
<template>
  <div>

      <div class="container">
          <div class="row justify-content-center">
              <div class="col-md-6">

                   <div class="card mb-3">
                       <!-- style="max-width: 18rem;" -->
                        <div class="card-header bg-info">Header</div>
                        <div class="card-body">
                           <ul class="notification_ul" style="list-style:none;">
                               <li><span class="">Left</span> <span class="pull-right" style="float:right;">Right</span> </li>

                           </ul>
                        </div>
                    </div>
                    <a href="#" class="btn btn-primary">Button</a>

              </div>
          </div>
      </div>
     
  </div>
</template>
<script>
export default {
    
}
</script>

<style scoped>
.notification_ul li{
    border-bottom: 1px solid gray;
}
</style>