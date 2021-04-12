<?php require_once 'includes/header.php'; ?>

<?php 

$pid = $_POST["productId"];
$row = $connect->query( "SELECT quantity, product_name, rate FROM product WHERE product_id = '$pid'" ); 
$product_data= $row->fetch_assoc();


?>


<div class="row">
  <div class="col-md-12">
      <div class="panel panel-success">
        <div class="panel-heading">Please verify the details and finalize payment</div>
          <div class="panel-body">
    <form class="form-horizontal" id="submitPurchaseForm" action="php_action/createPurchase.php" method="POST"> 
    <h4>Customer Details</h4><hr style="margin-top: 10px;">
  <div class="form-group">
    <label class="control-label col-sm-2" for="name">Customer Name</label>
    <div class="col-sm-9"> 
      <input type="text" class="form-control" name="name" id="name" placeholder="Enter customer's full name" value="<?php echo $_POST["name"]; ?>" readonly="readonly">
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="contact">Contact</label>
    <div class="col-sm-9"> 
      <input type="text" class="form-control" name="contact" id="contact" placeholder="Enter customer's phone number" value="<?php echo $_POST["contact"]; ?>" readonly="readonly">
    </div>
  </div>



  <h4 style="margin-top:40px;">Order Details</h4><hr style="margin-top: 10px;">
    <div class="form-group">
    <label class="control-label col-sm-2" for="date">Order Date</label>
    <div class="col-sm-9">
       <input type="text" class="form-control" name="date" id="date" value="<?php echo $_POST["date"]; ?>" readonly="readonly">
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="name">Selected Product</label>
    <div class="col-sm-9"> 
    <input type="text" class="form-control" name="product_name" id="product_name" value="<?php echo $product_data['product_name'];?>" readonly="readonly">      
    </div>
  </div>


 <div class="form-group">
    <label class="control-label col-sm-2" for="name">Product ID</label>
    <div class="col-sm-9"> 
    <input type="text" class="form-control" name="product_id" id="product_id" value="<?php echo $pid ;?>" readonly="readonly">      
    </div>
  </div> 

<div class="check"><p>There are <b> <?php echo $product_data['quantity'];
?></b> <?php echo $product_data['product_name'] ;?> in your stock. Please verify that customer need doesn't exceed our stock. If it exceeds, go back to previous page and consider limiting the no. of items as per our stock.</p>

<div class="form-group">
    <label class="control-label col-sm-2" for="contact">No of items</label>
    <div class="col-sm-9"> 
      <input type="number" class="form-control" name="numberOfItems" id="numberOfItems" value="<?php echo $_POST["numberOfItems"]; ?>" readonly="readonly">
    </div>
  </div></div>


  <div class="form-group">
    <label class="control-label col-sm-2" for="contact">Vat applicable</label>
    <div class="col-sm-9"> 
      <input type="text" width="100px" class="form-control" name="vat" id="vat" value="<?php echo $_POST["vat"]; ?>" readonly="readonly">
    </div>
  </div>


    <div class="form-group">
    <label class="control-label col-sm-2" for="contact">Discount (%)</label>
    <div class="col-sm-9"> 
      <input type="text" width=100px class="form-control" name="discount" id="discount" value="<?php echo $_POST["discount"]; ?> " readonly="readonly">
    </div>
  </div>


<h4 style="margin-top:40px;">Cost Details (Costs are in Taka)</h4><hr style="margin-top: 10px;">
    <div class="form-group">
    <label class="control-label col-sm-2" for="date">Previous price</label>
    <div class="col-sm-9">
       <input type="number" class="form-control" name="fixPrice" id="fixPrice" value="<?php echo $product_data['rate']; ?>" readonly="readonly">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="date">Price (1 Unit)</label>
    <div class="col-sm-9">
       <input type="number" class="form-control" name="unitPrice" id="unitPrice" value="<?php echo $product_data['rate']; ?>">
    </div>
  </div>


    <div class="form-group">
    <label class="control-label col-sm-2" for="date">Sub-total</label>
    <div class="col-sm-9">
       <input type="text" class="form-control" name="subTotal" id="subTotal" value="<?php
       $numberOfItems = $_POST["numberOfItems"];
       $unitPrice = $product_data['rate'];
       $subTotal = $numberOfItems * $unitPrice;
        echo $subTotal; 
        ?>"
        readonly="readonly">
    </div>
  </div>


    <div class="form-group">
    <label class="control-label col-sm-2" for="date">Discount to be applied</label>
    <div class="col-sm-9">
       <input type="text" class="form-control" name="discounted" id="discounted" value="<?php
       $discountPercent = $_POST["discount"];
       $discounted = $subTotal * ($discountPercent/100);
        echo $discounted; 
        ?>"
        readonly="readonly">
    </div>
  </div>


    <div class="form-group">
    <label class="control-label col-sm-2" for="date"> Grand Total </label>
    <div class="col-sm-9">
       <input type="text" class="form-control" name="finalSubtotal" id="finalSubtotal" value="<?php
       $finalSubtotal = $subTotal - $discounted;
        echo $finalSubtotal; 
        ?>"
        readonly="readonly">
    </div>
  </div>

<br>
<p>After applying 0% vat to the discounted total</p><br>

    <div class="form-group">
    <label class="control-label col-sm-2" for="date">Total payable</label>
    <div class="col-sm-9">
       <input type="text" class="form-control" name="total" id="total" value="<?php
       $total = $finalSubtotal;
        echo $total; 
        ?>"
        readonly="readonly">
    </div>
  </div>


<h4 style="margin-top:40px;">Payment Details</h4><hr style="margin-top: 10px;">
    <div class="form-group">
    <label class="control-label col-sm-2" for="date">Payment Type</label>
    <div class="col-sm-9">
       <select class="form-control" name="paymentType" id="paymentType" required>
        <option value=""></option>
         <option value="cash">Cash</option>
         <option value="card">Debit/Credit Card</option>
         <option value="ebanking">Internet Banking</option>
         <option value="upi">Unified Payment Interface (UPI)</option>
       </select>
    </div>
  </div>


    <div class="form-group">
    <label class="control-label col-sm-2" for="contact">Amount Paid</label>
    <div class="col-sm-9"> 
      <input onkeyup='Calculate();' type="number" class="form-control" name="paid" id="paid" placeholder="How much amount did the customer pay?" required>
    </div>
  </div>


    <div class="form-group">
    <label class="control-label col-sm-2" for="contact">Due</label>
    <div class="col-sm-9"> 
      <input type="number" class="form-control" name="due" id="due" required readonly="readonly">
    </div>
  </div>

<button style="margin: 30px 0 30px 0;" type="submit" class="btn btn-primary" id="addOrdersBtn">Save order</button>
</form>


      </div>
    </div>  
  </div>
</div>


<script>
  $(document).ready(function(){
    $("#unitPrice").change(function(){
      var subTotal = this.value * $("#numberOfItems").val();
      $("#subTotal").val( subTotal );
      $("#finalSubtotal").val( subTotal );
      $("#total").val( subTotal );
      $("#paid").val(subTotal);
    });

    $("#paid").change(function(){
      $('#due').val( parseFloat($("#total").val()) - parseFloat(this.value) );
    });




  });


function Calculate()
{
  var total = document.getElementById('total').value;
  var paid = document.getElementById('paid').value; 
  var due = parseFloat(total) - parseFloat(paid);
  document.getElementById('due').value = parseInt(due);
}
</script>

<?php require_once 'includes/footer.php'; ?>