<script>
jQuery(function($) {    


    $(".edit_record").click(function() {  
     
     // alert($(this).closest('tr').find('td').eq(1).text());
      
      var c_name = $(this).closest('tr').find('td').eq(1).text();
      var c_rate = $(this).closest('tr').find('td').eq(2).text(); 
      var c_status = $(this).closest('tr').find('td').eq(3).text(); 
      
      $('#edit_modal #stationery_item_id').val($(this).val()) ; 
      $('#edit_modal #stationery_item_name').val(c_name) ; 
      $('#edit_modal #rate').val(c_rate) ; 
      $('#edit_modal input:radio[value='+ c_status +']').prop('checked', true);  
                
    });
    
    
    $('.del_record').click(function() {  
        if (confirm('Are U sure want to delete ??')) {
             $.ajax({
                    url: "<?php echo site_url('delete-record');?>",
                    type: "post",
                    data: { tbl : 'stationery_item_info', id: $(this).val() },
                    success: function(d) {  
                        alert(d);
                        location.reload();
                    }
             });
         }
        
     });  

});
</script> 