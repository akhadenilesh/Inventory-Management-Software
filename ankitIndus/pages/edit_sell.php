<!-- Content Wrapper. Contains page content  -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2 mt-3">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><!-- Dashboard v2 --></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">new sell</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

      <div class="card rounded-0">
        <div class="card-header">
          <h5 class="">Make a sell here</h5>
        </div>

        <?php
        if (isset($_GET['edit_id'])) {
          $edit_id = $_GET['edit_id'];
          $sell_data = $obj->find('invoice', 'id', $edit_id);
          $all_invoice_detils_res = $obj->getInvoiceDetails($edit_id);
          if ($sell_data) {
        ?>
            <div class="card-header">
              <p>Invoice number : <?= $sell_data->invoice_number; ?></p>
            </div>
            <div class="card-body">

              <form id="editSellForm" onsubmit=" return false">
                <div class="order-header">
                  <div class="row">
                    <div class="col-md-6 col-lg-6">
                      <div class="form-group">
                        <label for="customer-name">Customer name</label>
                        <select name="customer_name" id="customer_name" class="form-control select2">
                          <?php

                          $all_customer = $obj->all('member');
                          $select_val = $sell_data->customer_id;

                          foreach ($all_customer as $customer) {
                            if ($select_val == $customer->id) {
                              $selected = 'selected';
                            } else {
                              $selected = '';
                            }
                          ?>
                            <option <?php echo $selected; ?> value="<?= $customer->id; ?>"><?= $customer->name; ?></option>
                          <?php
                          } ?>
                        </select>
                      </div>

                    </div>
                    <div class="col-md-6 col-lg-6">
                      <label for="orderdate">Order date</label>
                      <input type="text" class="form-control datepicker" name="orderdate" id="orderdate" autocomplete="off" value="<?= date('d-m-Y', strtotime($sell_data->order_date)); ?>">
                      <input type="text" hidden name="invoice_id" value="<?= $sell_data->id; ?>">
                    </div>
                  </div>
                </div>
                <div class="card p-4" style="background: #f1eaea40">
                  <table>
                    <thead>
                      <th>#</th>
                      <th>Product</th>
                      <th>Total Qty</th>
                      <th>Old Price</th>
                      <th>HNS Code</th>
                      <th>GST %</th>
                      <th>MRP</th>
                      <th>Order Qty</th>
                      <th>Discount</th>
                      <th>Total Price</th>
                      <th>GST Price</th>
                    </thead>
                    <tbody id="editInvoiceItem">
                      <!-- invoice item will show here by ajax  -->
                      <?php
                      print_r($all_invoice_detils_res);
                      foreach ($all_invoice_detils_res as $all_invoice_res) {
                      ?>

                        <tr>
                         
                          <td><b class="si_number">1</b></td>
                          <td>
                            <input type="text" hidden name="pid[]" value="<?= $all_invoice_res->pid; ?>">
                            <input type="text" class="form-control form-control-sm pid" readonly id="product_name" name="product_name[]" style="min-width: 250px; font-weight: 500;" value="<?= $all_invoice_res->product_name; ?>">
                          </td>
                          <td><input type="text" class="form-control form-control-sm qaty text-center" name="total_quantity[]" placeholder="Qty" readonly style="max-width: 80px; font-size: 12px;" value="<?= $all_invoice_res->total_qty; ?>"></td>

                          <td><input type="number" class="form-control form-control-sm oldPrice text-center" name="price[]" placeholder="Old ₹" readonly style="max-width: 90px; color: red; font-size: 12px;" value="<?= $all_invoice_res->old_price; ?>"></td>

                          <td><input type="text" class="form-control form-control-sm hnscode text-center" name="hnscode[]" placeholder="HSN" readonly style="max-width: 80px; font-size: 12px;" value="<?= $all_invoice_res->hns_code; ?>"></td>

                          <td><input type="number" class="form-control form-control-sm gst text-center" name="gst[]" placeholder="GST %" readonly style="max-width: 70px; font-size: 12px;" value="<?= $all_invoice_res->gst_percent; ?>"></td>

                          <td><input type="number" class="form-control form-control-sm price text-center" name="price[]" placeholder="Price ₹" style="max-width: 90px;" value="<?= $all_invoice_res->mrp; ?>"></td>

                          <td><input type="number" class="form-control form-control-sm oqty text-center" name="orderQuantity[]" placeholder="Order" style="max-width: 80px;" value="<?= $all_invoice_res->order_qty; ?>"></td>

                          <td><input type="number" class="form-control form-control-sm discount text-center" name="discount[]" placeholder="Disc. %" style="max-width: 70px; font-size: 12px;" value="<?= $all_invoice_res->discount; ?>"></td>

                          <td><input type="number" class="form-control form-control-sm tprice text-center" name="totalPrice[]" placeholder="Total" readonly style="max-width: 100px;" value="<?= $all_invoice_res->total_price; ?>"></td>

                          <td><input type="number" class="form-control form-control-sm gstprice text-center" name="gstPrice[]" placeholder="GST Amt" readonly style="max-width: 90px;" value="<?= $all_invoice_res->gst_price; ?>"></td>

                          <td><input type="text" class="form-control form-control-sm pro_name" name="pro_name[]" style="display: none;"  value="<?= $all_invoice_res->product_name; ?>"></td>
                          <td>
                            <button type="button" class="btn btn-danger btn-sm pl-3 pr-3 cancelThisItem" id="cancelThisItem"><i class="fas fa-times"></i></button>
                          </td>
                        </tr>
                      <?php
                      }
                      ?>


                    </tbody>
                  </table>
                  <div class="form-group text-right mt-3">
                    <button type="button" class="btn btn-primary pl-5 pr-5" id="EditaddNewRowBtn">Add</button>
                  </div>
                </div>
                <div class="invoice-area card pt-3" style="background: #f1eaea40">
                  <div class="row">
                    <div class="com-md-8 offset-md-2 col-lg-8 offset-lg-2">
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-3">
                            <label for="subtotal">Subtoal</label>
                          </div>
                          <div class="col-md-8">
                            <input type="number" class="form-control form-control-sm" name="subtotal" id="subtotal" value="<?= $sell_data->sub_total; ?>">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-3">
                            <label for="totalgst">GST</label>
                          </div>
                          <div class="col-md-8">
                            <input type="number" class="form-control form-control-sm" name="totalgst" id="totalgst" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-3">
                            <label for="billamount">Bill Amount</label>
                          </div>
                          <div class="col-md-8">
                            <input type="number" class="form-control form-control-sm" name="billamount" id="billamount" readonly>
                          </div>
                        </div>
                      </div>



                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-3">
                            <label for="payMethode">Payment Methode</label>
                          </div>
                          <div class="col-md-8">
                            <select name="payMethode" id="payMethode" class="form-control form-control-sm select2">
                              <option selected disabled>Select a payment methode</option>
                              <?php
                              $all_methode = $obj->all('paymethode');
                              foreach ($all_methode as $payMethode) {
                              ?>
                                <option value="<?= $payMethode->name; ?>"><?= $payMethode->name; ?></option>
                              <?php
                              } ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="form-group text-center">
                        <button type="submit" class="btn btn-success btn-block" id="editSellBtn">Edit sell</button>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            </form>
      </div>

    <?php
          } else {
    ?>
      <div class="alert alert-danger">No data found for edit</div>
  <?php
          }
        }
  ?>

    </div>
</div><!--/. container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper