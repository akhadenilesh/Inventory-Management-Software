<style>
  @page {
    margin: 5mm 10mm;
  }

  body {
    font-family: Arial, sans-serif;
    font-size: 12px;
  }

  .invoice-box {
    width: 100%;
    padding: 10px;
    border: 1px solid #000;
  }

  .header-table,
  .customer-table,
  .items-table,
  .summary-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 10px;
  }

  .auth-table {
    width: 100%;
    border-collapse: collapse;
  }

  .header-table td,
  .customer-table td,
  .items-table td,
  .items-table th,
  .summary-table td {
    border: 1px solid #000;
    padding: 4px;
  }

  .auth-table td {

    padding: 4px;
  }

  .items-table th {
    background: #f0f0f0;
  }

  .text-center {
    text-align: center;
  }

  .text-right {
    text-align: right;
  }

  .no-border td {
    border: none;
  }

  @media print {

    .view_sell_button-area,
    footer,
    .no-print {
      display: none !important;
    }
  }
</style>

<title>Invoice - <?= $customer->name ?></title>
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content mt-5">
    <div class="container-fluid">
      <div class="card view_sell_page_info">
        <div class="invoice-box">
          <table class="header-table">
            <tr>
              <td colspan="2" style="font-size: 12px; text-align: center">
                <h4><b>ANKIT INDUSTRIAL SOLUTIONS</h4>
                Building Trust Through Quality & Service<br>
                Proprietor: Jagdish Indramal Parmar<br>
                GST No: 27DEPPP8352J1ZO | PAN No: DEPPP8352J<br>
                Mobile: +91 87964 68644 | Email: ankitindustrialsolutions2024@gmail.com<br>
                Address: Survey No. 20/3A, Navnath Colony, Near Raigad Bazar, Post - Shilphata, Khopoli, Tal. Khalapur, Dist. Raigad - 410203<br></b>
                <b>We are Stockists and Dealers in: Welding Accessories, Taparia Tools, V-Belts, Nuts & Bolts, Oil Seals, Compressors, Generators, and Spare Parts.</b>
              </td>
            </tr>
          </table>
          <?php
          if (isset($_GET['view_id'])) {
            $view_id = $_GET['view_id'];
            $sell_total = $obj->find('invoice', 'id', $view_id);
            $customer = $sell_total->customer_id;
            $customer = $obj->find('member', 'id', $customer);
            $customer_name = preg_replace('/[^a-zA-Z0-9_-]/', '_', $customer->name); // Safe file name
            if ($sell_total) {
          ?>
              <table class="customer-table">
                <tr>
                  <td>
                    <b>To:</b> <?= $customer->name ?><br>
                    <b>GST No:</b> <?= $customer->gstno ?><br>
                    <b>Address:</b> <?= $customer->address ?><br>
                    <b>Phone:</b> <?= $customer->con_num ?><br>
                    <b>Email:</b> <?= $customer->email ?><br>
                  </td>
                  <td>
                    <b>Invoice No:</b> <?= $sell_total->invoice_number ?><br>
                    <b>Invoice Date:</b> <?= date('d-m-Y', strtotime($sell_total->order_date)) ?><br>
                    <b>Challan No:</b> <?= $sell_total->challan_no ?><br>
                    <b>Challan Date:</b> <?= date('d-m-Y', strtotime($sell_total->challan_date)) ?><br>
                    <b>Purchase Order No:</b> <?= $sell_total->po_no ?><br>
                    <b>Purchase Order Date:</b> <?= date('d-m-Y', strtotime($sell_total->po_date)) ?>
                  </td>
                </tr>
              </table>

              <table class="items-table">
                <thead>
                  <tr class="text-center">
                    <th>Sr. No</th>
                    <th>Particulars</th>
                    <th>HSN Code</th>
                    <th>Qty</th>
                    <th>Rate</th>
                    <th>Unit</th>
                    <th>Amount</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $invoice_id = $sell_total->id;
                  $all_product = $obj->findWhere('invoice_details', 'invoice_no', $invoice_id);
                  
                  // $i = 0;
                  $i = 1;
                  foreach ($all_product as $products) {
                    $p = $obj->find('products', 'id', $products->pid);
                    echo "<tr>
                  <td class='text-center'>{$i}</td>
                  <td>{$products->product_name} {$p->brand_name}</td>
                  <td class='text-center'>{$p->hnscode}</td>
                  <td class='text-center'>{$products->quantity}</td>
                  <td class='text-right'>" . number_format($products->price / $products->quantity, 2) . "</td>
                  <td class='text-center'>pcs</td>
                  <td class='text-right'>" . number_format($products->price, 2) . "</td>
                </tr>";
                    $i++;
                  }
                  ?>
                </tbody>
              </table>

              <table class="summary-table">
                <tr>
                  <?php
                  $type = strtolower($customer->gst_type);
                  if ($type == 'sgst') {
                  ?>
                    <td colspan="5" rowspan="4"><b>Total in Words:</b> <?= ucwords(getIndianCurrency($sell_total->bill_amount)); ?></td>
                  <?php
                  } else {
                  ?>
                    <td colspan="5" rowspan="3"><b>Total in Words:</b> <?= ucwords(getIndianCurrency($sell_total->bill_amount)); ?></td>
                  <?php
                  }
                  ?>
                  <td colspan='6'><b>Subtotal</b></td>
                  <td class="text-right"><?= number_format($sell_total->sub_total, 2) ?></td>
                </tr>
                <?php
                $totalgst = $sell_total->total_gst;
                if ($type == 'sgst') {
                  $halfGst = $totalgst / 2;
                  echo "<tr><td colspan='6'><b>SGST (9%)</b></td><td class='text-right'>" . number_format($halfGst, 2) . "</td></tr>
                    <tr><td colspan='6'><b>CGST (9%)</b></td><td class='text-right'>" . number_format($halfGst, 2) . "</td></tr>";
                } else {
                  echo "<tr><td colspan='6'><b>IGST (18%)</b></td><td class='text-right'>" . number_format($totalgst, 2) . "</td></tr>";
                }
                ?>
                <tr>
                  <td colspan="6"><b>Total Invoice Value</b></td>
                  <td class="text-right"><b><?= number_format(round($sell_total->bill_amount)) ?>.00</b></td>
                </tr>
              </table>

              <table class="auth-table" style="margin-top: 20px;">
                <tr>
                  <td><b>Bank Details:<br>
                      Bank: State Bank of India<br>
                      A/C No: 42589341233<br>
                      Branch: Khopoli<br>
                      IFSC: SBIN0005551</b>
                  </td>
                  <td><b>TERMS & CONDITIONS:<br>
                      • Subject to KHALAPUR JURIDICTION.<br>
                      • Goods once sold will not be taken back.<br>
                      • Our responsibility ceases as soon as the goods leave our premises<br>
                      • Payment within due date.<br></b>
                  </td>

                  <td style="text-align: right;"><br><br>

                    <b>Authorized Signature<br>
                      ANKIT INDUSTRIAL SOLUTIONS
                    </b>
                  </td>
                </tr>
              </table>
        </div>
    <?php
            }
          }
    ?>

    <div class="view_sell_button-area">
      <div class="btn-group" role="group" aria-label="Basic example">
        <a href="index.php?page=edit_sell&&edit_id=<?= $sell_total->id; ?>"" class=" btn btn-success rounded-0 ml-2"><i class="fas fa-edit"></i> Edit Sell</a>
        <button type="button" onclick="window.print()" class="btn btn-primary ml-2"> <i class="fas fa-file-pdf"></i> Print</button>
      </div>
    </div>
      </div>


    </div>


  </section>

</div>
<?php
function getIndianCurrency($number)
{
  $decimal = round($number - floor($number), 2) * 100;
  $no = floor($number);
  $words = array(
    '',
    'One',
    'Two',
    'Three',
    'Four',
    'Five',
    'Six',
    'Seven',
    'Eight',
    'Nine',
    'Ten',
    'Eleven',
    'Twelve',
    'Thirteen',
    'Fourteen',
    'Fifteen',
    'Sixteen',
    'Seventeen',
    'Eighteen',
    'Nineteen',
    'Twenty',
    'Thirty',
    'Forty',
    'Fifty',
    'Sixty',
    'Seventy',
    'Eighty',
    'Ninety'
  );
  $digits = ['', 'Hundred', 'Thousand', 'Lakh', 'Crore'];
  $str = array();
  $i = 0;
  while ($no > 0) {
    $divider = ($i == 2) ? 10 : 100;
    $number = floor($no % $divider);
    $no = floor($no / $divider);
    if ($number) {
      $plural = (($counter = count($str)) && $number > 9) ? '' : null;
      $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
      $str[] = ($number < 21) ? $words[$number] . " " . $digits[$i] . $plural . " " . $hundred
        : $words[floor($number / 10) + 18] . " " . $words[$number % 10] . " " . $digits[$i] . $plural . " " . $hundred;
    } else {
      $str[] = null;
    }
    $i++;
  }

  $Rupees = implode('', array_reverse($str));
  $paise = ($decimal) ? "And " . $words[$decimal / 10] . " " . $words[$decimal % 10] . " Paise" : '';
  return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise . " Only";
}

?>