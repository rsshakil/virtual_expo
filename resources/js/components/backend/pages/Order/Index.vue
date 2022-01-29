<template>            <!-- /.card-header -->
    <TableContent class="py-5"  style="margin-top:-20px;"  v-if="typeof(dataList) == 'object'" :searchForm="searchForm" :sortingForm="sortingForm" :isAddItem="isAddItem" :isEditBtn="isEditBtn" :isDelBtn="isDelBtn" :isActionBtn="isActionBtn" :cardTitle="cardTitle" :columnsHead="columnsHead" :columnsBody="columnsBody" :dataList="dataList" :showEditForm="showEditForm" :deleteItem="deleteItem" :getDataList="getDataList" :excelFields="excelFields" :excelTitle="excelTitle" :isDownload="isDownload" :isSearchBox="isSearchBox" route="admin"></TableContent>
</template>
<script>
import mixin from '../../../../src/mixin';
export default {
    mixins:[mixin],

    created(){
        this.generalApi = "order"
        this.cardTitle ="Order"
        this.columnsHead.push('Sn','Total Quantity', 'Customer ID', 'Total Price', 'Action')
      
        this.columnsBody.push('total_qty','total_price')
        // this.columnsBodyExtra = 
         this.excelTitle = "RSM List"

         this.excelFields = {
                "Total Quantity"       : "total_qty",
                "Price"          : "total_price",
        }
       
        
    }
}
</script>
