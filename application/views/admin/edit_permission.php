<?php
/*echo "<pre>";
print_r($_SESSION['userPermissions']);die;*/
?>

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Edit Permissions</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/permissions');?>">Back</a></li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="table-responsive">
        <form name="saverolepermission" action="" method="post" id="dataForm" novalidate="novalidate">
          <div class="form-group">
            <div class="row">
              <div class="col-sm-12">
                <label>Name</label>
                <input type="text" class="form-control bg-white valid" name="name" value="<?php echo $subadmin_name_by_id[0]->name;?>" aria-required="true" aria-invalid="false">
                <span class="text-danger"></span>
              </div>
            </div>
          </div>
          <table class="table text-center" id="dataTable">
            <thead class="bg-white">
              <tr>
                <th width="20%" style=""><label>
                  <input type="checkbox" id="checkAllCheckbox" name="checkallView" value="1" style="margin:3px;"><span>Check ALL</span>
                  </label>
                </th>
                <th colspan=""><label>
                  <input type="checkbox" id="checkAllView" name="checkallView" value="1"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                  </label>
                </th>
                <th colspan=""><label>
                  <input type="checkbox" id="checkAllAdd" name="checkallView" value="1"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                  </label>
                </th>
                <th colspan=""><label>
                  <input type="checkbox" id="checkAllEdite" name="checkallView" value="1"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                  </label>
                </th>
                <th colspan=""><label>
                  <input type="checkbox" id="checkAllDelete" name="checkallView" value="1"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                  </label>
                </th>
              </tr>
              <input type="hidden" name="role_id" value="<?php echo $this->uri->segment(4); ?>">
              <?php
              $role_id = $this->uri->segment(4);
              	foreach ($allModules as $key => $value) { 
              			$curretModuleArray =$this->roles->getRoleWiseAssignPermission($role_id,$value->id);
              		?>
              		<tr>
		                <td align="left"><?php echo $value->name ;?></td>
		                <td><label>
		                  <input type="checkbox" name="view[]" value="<?php echo $this->uri->segment(4); ?>,<?php echo $value->id ;?>,1" class="checkedViewEditBox" style="margin:3px;" <?php if(in_array('View', $curretModuleArray)){ ?> checked <?php }?>><span>View</span>
		                  </label>
		                </td>
		                <td><label>
		                  <input type="checkbox" name="add[]" value="<?php echo $this->uri->segment(4); ?>,<?php echo $value->id ;?>,2" class="checkedAllAddBox" style="margin:3px;" <?php if(in_array('Add', $curretModuleArray)){ ?> checked <?php }?>><span>Add</span>
		                  </label>
		                </td>
		                <td><label>
		                  <input type="checkbox" name="edit[]" value="<?php echo $this->uri->segment(4); ?>,<?php echo $value->id ;?>,3" class="checkedAllEditBox" style="margin:3px;" <?php if(in_array('Edit', $curretModuleArray)){ ?> checked <?php }?>><span>Edit</span>
		                  </label>
		                </td>
		                <td><label>
		                  <input type="checkbox" name="delete[]" value="<?php echo $this->uri->segment(4); ?>,<?php echo $value->id ;?>,4" class="checkedDeleteEditBox" style="margin:3px;" <?php if(in_array('Delete', $curretModuleArray)){ ?> checked <?php }?>><span>Delete</span>
		                  </label>
		                </td>
              		</tr>
              <?php	}
              ?>
              
              
              <tr>
                <td colspan="5">
                  <input type="submit" name="submit" value="Save" class="btn btn-info pl-3 pr-3 pt-1 pb-1">
                </td>
              </tr>
        
        </thead>
        <tbody>
        </tbody>
        </table>
      </form></div>
      </div>
    </section>
  </div>


