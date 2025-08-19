<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><!-- Dashboard v2 --></h1>
        </div><!-- /.col -->
        <div class="col-sm-6 mt-4">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Category</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <hr>
      <div class="row">
        <div class="col-md-8 offset-md-2 col-lg-8 offset-lg-2 mt-3">
          <div class="card">
            <?php
            if (isset($_GET['edit_id'])) {
              $edit_id = $_GET['edit_id'];
              $data = $obj->find('member', 'id', $edit_id);

              if ($data) {
            ?>
                <div class="card-header">
                  <h4 class="float-left">Update this customer </h4>
                  <h4 class="float-right"><b>Customer id</b> : #<?= $data->member_id; ?></h4>
                </div>
                <div class="card-body">
                  <form id="editMemberForm">
                    <div class="form-group">
                      <label for="name">Company Name *:</label>
                      <input type="text" class="form-control add-member" id="name" name="name" value="<?= $data->name; ?>">
                      <input type="text" hidden name="id" value="<?= $edit_id; ?>"> <!-- pass id with hidden field -->
                    </div>
                    <div class="form-group">
                      <label for="gstno">GST No *:</label>
                      <input type="text" class="form-control add-member" id="gstno" name="gstno" value="<?= $data->gstno; ?>">
                    </div>

                    <div class="form-group">
                      <label for="gst_type">GST Type:</label>
                      <select class="form-control" name="gst_type" id="gst_type">
                        <option value="SGST" <?= $data->gst_type == 'SGST' ? 'selected' : '' ?>>SGST</option>
                        <option value="IGST" <?= $data->gst_type == 'IGST' ? 'selected' : '' ?>>IGST</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="address">Address:</label>
                      <textarea rows="3" class="form-control" id="address" name="address"><?= $data->address; ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="contact">Contact number *:</label>
                      <input type="text" class="form-control add-member" id="contact" name="contact" value="<?= $data->con_num; ?>">
                    </div>
                    <div class="form-group">
                      <label for="email">Email:</label>
                      <input type="email" class="form-control add-member" id="email" name="email" value="<?= $data->email; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block rounded-0">Update customer</button>
                  </form>

              <?php
              } else {
                header("location:index.php?page=error_page");
              }
            }
              ?>
                </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
</div><!--/. container-fluid -->
</section>
<!-- /.content -->
</div>

<script>
  // Wait for the page to be fully loaded before attaching event listeners
  document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM fully loaded and parsed");

    // Function to be called when GST No. input is finished (i.e., when focus is lost)
    function onGSTNoFinished() {
      const gstno = document.getElementById('gstno').value;
      console.log('GST No. entered:', gstno);
      
      // You can call an API or perform additional validation here if needed
    }

    // Attach event listener to the GST No. field for the 'blur' event
    const gstnoField = document.getElementById('gstno');
    if (gstnoField) {
      console.log("GST No. input field found, adding blur event listener");
      gstnoField.addEventListener('blur', onGSTNoFinished);
    } else {
      console.log("GST No. input field not found!");
    }
  });
</script>

