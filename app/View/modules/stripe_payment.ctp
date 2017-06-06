<?php echo $this->element('customized_header',array('title_for_layout',$title_for_layout));?>    
<section class="content">
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">
           <a href="<?php echo Router::url(array('controller'=>'modules','action'=>'index','admin'=>false))?>" class="btn bg-navy margin">Back</a>
      </h3>
    </div>

    <div class="box-body">
      <!-- Horizontal Form -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"><!--Horizontal Form--></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?php echo $this->Form->create('StripePayments',array('class'=>'form-horizontal','id'=>'stripe_form'));?>
          <div class="box-body">
            <div class="form-group ">
              <label for="inputEmail3" class="col-sm-2 control-label">Amount($)</label>
              <div class="col-sm-8">
                <?php 
                      echo $this->Form->input('stripe_amount',array(
                                              'div'=>false,
                                              'label'=>false,
                                              'required'=>false,
                                              'type'=>'number',
                                              'step'=>'0.01',
                                              'style'=>'margin-top:10px',
                                              'placeholder'=>__('Stripe Amount ($)'),
                                              'class'=>'form-control stripe_amount'
                      ));
                      echo $this->Form->input('stripe_token',array(
                                               'type'=>'hidden',
                                               'class'=>'stripe_token'
                                              
                      ));
                      echo $this->Form->input('recurring_pay',array(
                                               'type'=>'hidden',
                                               'class'=>'recurring_pay'
                                              
                      ));
                ?>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <?php 
              echo $this->Form->button('Pay Using Stripe',array('div'=>false,
                                        'label'=>false,
                                        'type'=>'button',
                                        'onclick'=>'validate_form(0)',
                                        'class'=>'btn btn-info pull-left'
              ));
            ?>

            <?php 
              echo $this->Form->button('Recurring Payment',array('div'=>false,
                                        'label'=>false,
                                        'type'=>'button',
                                        'style'=>'margin-left:10px',
                                        'onclick'=>'validate_form(1)',
                                        'class'=>'btn btn-info pull-left'
              ));
            ?>
          </div>

          <div class="box-footer">
            
            <?php 
              if(!empty($charge)){
                  pr($charge);
              }
            ?>

          </div>
          <!-- /.box-footer -->
        <?php echo $this->Form->end();?>
      </div>
      <!-- /.box -->
    </div>
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->

<?php 
    echo $this->Form->button('Pay Using Stripe',array('div'=>false,
                            'label'=>false,
                            'type'=>'button',
                            'id'=>'customButton',
                            'style'=>'display:none',
                            'class'=>'btn btn-info pull-left'
    ));
?>

<script src="https://checkout.stripe.com/checkout.js"></script>
<script>
var handler = StripeCheckout.configure({
  key: 'your stripe publishable key',
  //image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
  locale: 'auto',
  token: function(token) {
     token_id = token.id;
     $('.stripe_token').val(token_id);
     $('#stripe_form').submit();

    // You can access the token ID with `token.id`.
    // Get the token ID to your server-side code for use.
  }
});

document.getElementById('customButton').addEventListener('click', function(e) {
  // Open Checkout with further options:
  handler.open({
    name: "Tushar'sStripe",
    description: 'Test Stripe Payment',
    zipCode: false,
    amount: $('stripe_amount').val() *100 // Amount in cents
  });
  e.preventDefault();
});

// Close Checkout on page navigation:
window.addEventListener('popstate', function() {
  handler.close();
});
</script>

<script type="text/javascript">
  
  function validate_form(recurring_pay){
      $('.recurring_pay').val(recurring_pay);
      var stripe_amount = $('.stripe_amount').val();
      if(stripe_amount.trim().length ==0){
        alert("Enter amount to proceed !!");
        return false;
      }else{
        $('#customButton').click();
      }
  }

</script>