<?php  include_once(VIEWPATH . '/inc/header.php'); ?>
 <section class="content-header">
  <h1>Franchises TS Invoice List</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-book"></i> TS Invoice</a></li> 
    <li class="active">Franchises TS Invoice List</li>
  </ol>
</section>
<!-- Main content -->
<section class="content"> 
  
        <div class="box box-info"> 
            <div class="box-header with-border">
              <h3 class="box-title text-white">Search Filter</h3>
            </div>
        <div class="box-body">
             <form method="post" action="" id="frmsearch">          
             <div class="row">   
                 <div class="form-group col-md-3"> 
                    <label>From Date</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right datepicker" id="srch_from_date" name="srch_from_date" value="<?php echo set_value('srch_from_date',$srch_from_date);?>">
                    </div>
                    <!-- /.input group -->                                             
                 </div> 
                 <div class="form-group col-md-3"> 
                    <label>To Date</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right datepicker" id="srch_to_date" name="srch_to_date" value="<?php echo set_value('srch_to_date',$srch_to_date);?>">
                    </div>
                    <!-- /.input group -->                                             
                 </div>
                 <div class="form-group col-md-4">
                    <label>Franchises</label>
                      <div class="input-group">
                        <?php echo form_dropdown('srch_franchise_id',array('' => 'All Franchise') + $franchise_opt  ,set_value('srch_franchise_id',$srch_franchise_id) ,' id="srch_franchise_id" class="form-control" ');?> 
                            
                      </div>                                   
                 </div>   
                  
                <div class="form-group col-md-2 text-left">
                    <br />
                    <button class="btn btn-success" name="btn_show" value="Show Reports'"><i class="fa fa-search"></i> Show Invoice</button>
                </div>
             </div>  
            </form>
         </div> 
         </div> 
         <?php if(($submit_flg)) { ?>         
         <div class="box box-success"> 
            <div class="box-header with-border">
              <h3 class="box-title text-white">Franchises Invoice List</h3> 
            </div>
            <div class="box-body">  
                <?php  if(!empty($record_list)) { ?>    
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr class="bg-blue-gradient">
                        <th>SNo</th>
                        <th>Invoice No</th>
                        <th>Date</th>
                        <th>Franchise</th> 
                        <th>No of AWBNo</th> 
                        <th>Amount</th> 
                        <th>Status</th> 
                        <th colspan="3">Action</th> 
                    </tr> 
                    </thead>
                    <tbody>
                        <?php 
                        $tot = 0;
                        foreach($record_list as $j => $info) {   
                           $tot += $info['ts_amount'];
                        ?>
                        <tr>
                            <td><?php echo ($j+1)?></td>
                            <td><?php echo $info['invoice_no']?></td>
                            <td><?php echo $info['invoice_date']?></td>
                            <td>
                                <?php //echo $info['contact_person']?>
                                <?php echo $franchise_list[$info['franchise_id']]?>
                            </td> 
                            <td class="text-center"><?php echo $info['awb_nos'];?></td> 
                            <td class="text-right"><?php echo number_format($info['ts_amount'],2);?></td>   
                            <td>
                                <?php echo $info['status']?>
                                <!--<?php echo $info['ts_franchise_invoice_id']?>-->
                            </td>
                            <td class="text-center">
                                <a  href="<?php echo site_url('print-ts-invoice-v2/'.$info['ts_franchise_invoice_id'].'/'.strtotime($info['invoice_date'])); ?>" target="_blank" class="btn btn-info btn-xs" title="Print"><i class="fa fa-print"></i></a>
                            </td>
                            <td class="text-center">
                                <button data-toggle="modal" data-target="#edit_modal" value="<?php echo $info['ts_franchise_invoice_id']?>" data-info="<?php echo $franchise_list[$info['franchise_id']] . " <br/> Amount: " . number_format($info['ts_amount'],2) ?>" class="edit_record btn btn-primary btn-xs" title="Edit" ><i class="fa fa-edit"></i></button>
                            </td>                              
                            <td class="text-center">
                                <button value="<?php echo $info['invoice_no']?>" data="ts_invoice_info" class="del_record btn btn-danger btn-xs" title="Delete"><i class="fa fa-remove"></i></button>
                            </td>
                        </tr>
                        <?php } ?>
                        <tfoot>
                            <tr>
                                <th class="text-right" colspan="5">Total</th> 
                                <th class="text-right"><?php echo number_format($tot,2)?></th>
                                <th colspan="3"></th>
                            </tr>
                        </tfoot>
                    </tbody>
                     
                </table>  
                 
                  <?php } ?>
            </div>
            <div class="box-footer with-border ">
               <div class="form-group col-sm-6 text-left">
                    <label>Total Records : <?php echo $total_records;?></label>
                </div>
                <div class="form-group col-sm-6 text-right">
                    <?php echo $pagination; ?>
                </div>
            </div>
            </div> 
            <?php } ?> 
        
           <div class="modal fade" id="edit_modal" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <form method="post" action="" id="frmedit">
                        <div class="modal-header">
                            
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h3 class="modal-title" id="scrollmodalLabel">Edit TS Invoice</h3>
                            <input type="hidden" name="mode" value="Edit" />
                            <input type="hidden" name="ts_franchise_invoice_id" id="ts_franchise_invoice_id" />
                        </div>
                        <div class="modal-body"> 
                            <div class="form-group">
                                <label>Invoice No</label>
                                <input class="form-control" type="number" step="any" name="invoice_no" id="invoice_no" value="" required="true">                                             
                             </div>    
                             <div class="form-group">
                                <label>Invoice Date</label>
                                <input class="form-control" type="date" name="invoice_date" id="invoice_date" value="" required="true">                                             
                             </div>
                             <div class="form-group">
                                <label>Franchise</label>     
                                <div class="cntn"></div>               
                             </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> 
                            <input type="submit" name="Save" value="Update"  class="btn btn-primary" />
                        </div> 
                        </form>
                    </div>
                </div>
            </div> 
           
         
</section>
<!-- /.content -->
<?php  include_once(VIEWPATH . 'inc/footer.php'); ?>
