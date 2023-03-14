<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Mange Subadmin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard');?>">Back</a></li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php if(!empty($this->session->flashdata('success'))){
          echo $this->session->flashdata('success');
      } ?>
      <div></div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <a href="manage-subadmin/add"><button class="btn btn-primary" style="float:right;">Add Subadmin</button></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Mobile</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($subadmin as $key => $value) { ?>
                    <tr>
                      <td><?php echo $value->first_name." ".$value->last_name;?></td>
                      <td><?php echo $value->email ;?></td>
                      <td><?php echo $value->name ;?></td>
                      <td><?php echo $value->mobile;?></td>
                      <td><?php echo $value->status == 1? "Active": "Inactive";?></td>
                      <td><a href="<?php echo base_url('admin/manage-subadmin/'.$value->id);?>"><i class="fas fa-edit"></i></a><a href="<?php echo base_url('admin/manage-subadmin/delete/'.$value->id);?>"><i class="fas fa-trash" style="margin-left:10px;"></a></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>