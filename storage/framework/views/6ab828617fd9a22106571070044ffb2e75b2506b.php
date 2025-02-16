<div  class="modal fade modal-lg" id="refundTicket<?php echo $value['id']; ?>" tabindex="-1" aria-labelledby="refundTicketLabel" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="photo">
                <div class="card-body mx-4">
                    <div class="row">
                        <div class="col-9">
                            <ul class="list-unstyled">
                                <li class="text-black mt-1"><h5><?php echo app('translator')->get('lang.terms_conditions'); ?></h5></li>
                                <li class="text-black">- <?php echo app('translator')->get('lang.conditions_1'); ?> </li>
                                <li class="text-black">- <?php echo app('translator')->get('lang.conditions_2'); ?></li>
                                <li class="text-black">- <?php echo app('translator')->get('lang.conditions_3'); ?></li>
                                <li class="text-black">- <?php echo app('translator')->get('lang.conditions_4'); ?></li>
                                <li class="text-black">- <?php echo app('translator')->get('lang.conditions_5'); ?></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <img style="width: 150px;float: right;" src="images/web/logo1.png" />
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" data-id="<?php echo $value['id']; ?>" class="btn btn-danger refund-ticket"><?php echo app('translator')->get('lang.send_request'); ?></a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get('lang.close'); ?></button>
            </div>
        </div>
    </div>
</div>

<?php /**PATH D:\LVTN\QLRapPhim\resources\views/web/refund_ticket_modal.blade.php ENDPATH**/ ?>