<?php
require_once '../init.php';
if (isset($_POST['getOrderItem'])) {
?>
  <tr>
    <td><b class="si_number">1</b></td>
    <td><select class="form-control form-control-sm select2 pid" id="product_name" name="pid[]" style="min-width: 250px; font-weight: 500;">
        <option selected disabled>Select a prduct</option>
        <?php
        $all_produdct_data = $obj->allWhere('products');
        foreach ($all_produdct_data as $produdct_data) {
        ?>
          <option value="<?= $produdct_data->id; ?>"><?= $produdct_data->product_name; ?> (<?= $produdct_data->brand_name; ?>)</option>
        <?php
        }
        ?>
      </select></td>
    <td><input type="text" class="form-control form-control-sm qaty text-center" name="total_quantity[]" placeholder="Qty" readonly style="max-width: 80px; font-size: 12px;"></td>

    <td><input type="number" class="form-control form-control-sm oldPrice text-center" name="price[]" placeholder="Old ₹" readonly style="max-width: 90px; color: red; font-size: 12px;"></td>

    <td><input type="text" class="form-control form-control-sm hnscode text-center" name="hnscode[]" placeholder="HSN" readonly style="max-width: 80px; font-size: 12px;"></td>

    <td><input type="number" class="form-control form-control-sm gst text-center" name="gst[]" placeholder="GST %" readonly style="max-width: 70px; font-size: 12px;"></td>

    <td><input type="number" class="form-control form-control-sm price text-center" name="price[]" placeholder="Price ₹" style="max-width: 90px;"></td>

    <td><input type="number" class="form-control form-control-sm oqty text-center" name="orderQuantity[]" placeholder="Order" style="max-width: 80px;"></td>

    <td><input type="number" class="form-control form-control-sm discount text-center" name="discount[]" placeholder="Disc. %" style="max-width: 70px; font-size: 12px;"></td>

    <td><input type="number" class="form-control form-control-sm tprice text-center" name="totalPrice[]" placeholder="Total" readonly style="max-width: 100px;"></td>

    <td><input type="number" class="form-control form-control-sm gstprice text-center" name="gstPrice[]" placeholder="GST Amt" readonly style="max-width: 90px;"></td>

    <!-- Hidden Product Name -->
    <td><input type="text" class="form-control form-control-sm pro_name" name="pro_name[]" style="display: none;"></td>
    <td><button type="button" class="btn btn-danger btn-sm pl-3 pr-3 cancelThisItem" id="cancelThisItem"><i class="fas fa-times"></i></button></td>
  </tr>
<?php
}

?>
<!-- <script>
  // Trigger after product is selected
  $(document).on('change', '.pid', function() {
    var selectedProductId = $(this).val();
    var currentSelect = $(this);
    var isDuplicate = false;

    $('.pid').each(function() {
      // If the value matches and it's not the current select
      if ($(this).val() === selectedProductId && this !== currentSelect[0]) {
        isDuplicate = true;

        // Scroll to the duplicate row
        $('html, body').animate({
          scrollTop: $(this).closest('tr').offset().top - 100
        }, 500);

        // Optional: Highlight the row
        $(this).closest('tr').addClass('duplicate-row');
        setTimeout(() => {
          $(this).closest('tr').removeClass('duplicate-row');
        }, 2000);

        // Reset the new select
        currentSelect.val(null).trigger('change');

        return false; // break loop
      }
    });
  });
</script> -->

<style>
  /* Optional highlight style */
  .duplicate-row {
    background-color: #da1f1cff !important;
    transition: background-color 0.20s ease;
  }
</style>