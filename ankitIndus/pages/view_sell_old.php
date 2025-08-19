<style>
  @page {
    margin-top: 150px;
    margin-bottom: 100px;
  }

  @media print {
    body {
      font-size: 12px;
    }

    .view_sell_payment_info {
      display: none;
    }

    .view_sell_button-area {
      display: none;
    }

    footer.main-footer {
      display: none;
    }

    .card.view_sell_page_info {
      margin-top: 100px;
    }
  }
</style>




<!-- Content Wrapper. Contains page content  -->
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content mt-5">
    <div class="container-fluid">
      <div class="card view_sell_page_info">
        <div class="card-header">
          <div class="purchase-suppliar-info">
            <p><i><b>Seller info</b></i></p>
            <p><b>Ankit Industrial Solution</b></p>
            <p>Building trust through quality & service</p>
            <p>Address : Srv no.20/3A, Navnath Colony, Near Raigad Bazar,</p>
            <p>Po. - shilphata Khopoli, Tal- Khalapur, Dist- Raigad - 410203.</p>
            <p>GST No : 27DEPPP8352J1ZO</p>
            <p>PAN No : DEPPP8352J</p>
            <p>Phone : +91 8796468644</p>
            <p>Email : ankitindustrialsolutions2024@gmail.com</p>
            <p>Prop : Jagdish Indramal Parmar</p>
          </div>
        </div>
        <div class="card-body">
				<?php
				if (isset($_GET['view_id'])) {
					$view_id = $_GET['view_id'];
					$sell_total = $obj->find('invoice', 'id', $view_id);

					$customer = $sell_total->customer_id;
					$customer = $obj->find('member', 'id', $customer);
					if ($sell_total) {
				?>
              <div class="row">
                <div class="col-md-4 col-lg-4">
                  <div class="purchase-suppliar-info">
                    <p><i><b>Customer</b></i></p>
                    <p><b>Name : <?= $customer->name; ?></b></p>
                    <p>GST No : <?= $customer->gstno; ?></p>
                    <p>Address : <?= $customer->address; ?></p>
                    <p>Phone : <?= $customer->con_num; ?></p>
                    <p>Email : <?= $customer->email; ?></p>
                    <p>Supliar id : <?= $customer->member_id; ?></p>
                  </div>
                </div>
                <div class="col-md-4 col-lg-4"></div>
                <div class="col-md-4 col-lg-4">
                  <div class="purchase-suppliar-info">
                    <p>Invoice No : <?= $sell_total->invoice_number; ?></p>
                    <p>Invoice Date : <?= $sell_total->order_date; ?></p>
                    <p>Challan No : <?= $sell_total->challan_no; ?></p>
                    <p>Challan Date : <?= $sell_total->challan_date; ?></p>
                    <p>Order No : <?= $sell_total->po_no; ?></p>
                    <p>Order Date : <?= $sell_total->po_date; ?></p>
                  </div>

                </div>
              </div>

              <table class="display dataTable text-center mt-4">
                <thead>
                  <tr>
                    <th>Sr.No</th>
                    <th>Product Name</th>
                    <th>HSN Code</th>
                    <th>QTY</th>
                    <th>Rate</th>
                    <th>Amount</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $invoice_id = $sell_total->id;


                  $all_product = $obj->findWhere('invoice_details', 'invoice_no', $invoice_id);
                  $i = 0;
                  foreach ($all_product as $products) {
                    $i++;
                    $pid = $products->pid;
                    $p_brand = $obj->find('products', 'id', $pid);
                  ?>
                    <tr>
                      <td><?= $i ?></td>
                      <td><?= $products->product_name . ' ' . $p_brand->brand_name  ?></td>
                      <td><?= $p_brand->hnscode ?></td>
                      <td><?= $products->quantity ?></td>
                      <td><?= $products->price / $products->quantity ?></td>
                      <td><?= $products->price ?></td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>

              <hr>
              <div class="row">
                <div class="col-md-8 col-lg-8">
                  <div class="view_sell_payment_info">
                    <h4 class="mt-4">Payments Information :</h4>
                    <table class="table table-bordered text-center">
                      <thead class="bg-info">
                        <th>#</th>
                        <th>Date</th>
                        <th>Payment type</th>
                        <th>Payment note</th>
                        <th>Payment amount</th>
                      </thead>
                      <tbody>
                        <?php
                        $all_payment = $obj->findWhere('sell_payment', 'customer_id', $customer->id);
                        $i = 0;
                        foreach ($all_payment as $payment) {
                          $i++;
                        ?>
                          <tr>
                            <th><?= $i; ?></th>
                            <th><?= $payment->payment_date; ?></th>
                            <th><?= $payment->payment_type; ?></th>
                            <th><?= $payment->pay_description; ?></th>
                            <th><?= $payment->payment_amount; ?></th>
                          </tr>
                        <?php
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-4 col-lg-4">
                  <div class="pruchase-view-description">
                    <table class="table">
                      <tr>
                        <td>Subtotal</td>
                        <td>:</td>
                        <td><?= number_format($sell_total->sub_total, 2); ?></td>
                      </tr>

                      <?php
                      $type = strtolower($customer->gst_type);
                      $totalgst = $sell_total->total_gst;

                      if ($type == 'sgst') {
                        $halfGst = $totalgst / 2;
                      ?>
                        <tr>
                          <td>SGST</td>
                          <td>: (9%)</td>
                          <td><?= number_format($halfGst, 2); ?></td>
                        </tr>
                        <tr>
                          <td>CGST</td>
                          <td>: (9%)</td>
                          <td><?= number_format($halfGst, 2); ?></td>
                        </tr>
                      <?php
                      } else {
                      ?>
                        <tr>
                          <td>IGST</td>
                          <td>: (18%)</td>
                          <td><?= number_format($totalgst, 2); ?></td>
                        </tr>
                      <?php
                      }
                      ?>

                      <tr>
                        <td>Total Invoice Value</td>
                        <td>:</td>
                        <td><?= number_format($sell_total->bill_amount, 2); ?></td>
                      </tr>
                    </table>
                  </div>
                </div>

              </div>

              <div class="view_sell_button-area">
                <div class="btn-group" role="group" aria-label="Basic example">
                  <a href="index.php?page=return_sell&&reurn_id=<?= $sell_total->id; ?>" class="btn btn-info rounded-0 ml-2"><i class="fas fa-reply-all"></i> Return Sell</a>
                  <a href="index.php?page=edit_sell&&edit_id=<?= $sell_total->id; ?>"" class=" btn btn-success rounded-0 ml-2"><i class="fas fa-edit"></i> Edit Sell</a>
                  <button type="button" onclick="window.print()" class="btn btn-primary ml-2"><i class="fas fa-file-pdf"></i> Print</button>
                </div>
              </div>
          <?php
            }
          }
          ?>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
    <!-- /.row -->
</div><!--/. container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper