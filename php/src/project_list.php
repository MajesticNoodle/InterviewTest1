<?php include'includes/config.php' ?> <div class="col-lg-12">
  <div class="card card-outline card-success" style="border:none;">
    <div class="card-header"> <?php if($_SESSION['login_type'] != 3): ?> <div class="card-tools">
        <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="./index.php?page=new_project">
          <i class="fa fa-plus"></i> Add New project </a>
          <form action="index.php?page=project_list" method="post" name="filter" style="float:right;">
            <div class="form-group">
              <select class="form-control" name='filterselect' onchange='this.form.submit()'>
                <option value="#">Please Select to Filter</option>
                <?php 
                $qry = $conn->query("SELECT * FROM users ");
                while($row= $qry->fetch_assoc()):
                ?>
                <option value="<?= $row['id']; ?>"><?= $row['firstname'].' '.$row['lastname'] ?></option>
                <?php
                endwhile;
                ?>
              </select>
              <noscript><input type="submit" value="Submit"></noscript>
            </div>
          </form>
      </div> <?php endif; ?> </div>
    <div class="card-body">
      <table class="table tabe-hover table-condensed" id="list">
        <colgroup>
          <col width="5%">
          <col width="35%">
          <col width="15%">
          <col width="15%">
          <col width="20%">
          <col width="10%">
        </colgroup>
        <thead>
          <tr>
            <th class="text-center">#</th>
            <th>Project</th>
            <th>Date Started</th>
            <th>Due Date</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody> <?php
					$i = 1;
					$stat = array("Pending","Started","In-Progress","On-Hold","Over Due","Done");
					$where = "";
          if(isset($_POST['filterselect'])){
            $filterid = $_POST['filterselect'];
          }
					if($_SESSION['login_type'] == 2){
						$where = " where manager_id = '{$_SESSION['login_id']}' ";
					}elseif($_SESSION['login_type'] == 3){
						$where = " where concat('[',REPLACE(user_ids,',','],['),']') LIKE '%[{$_SESSION['login_id']}]%' ";
					}
          if(!empty($_POST['filterselect'])){
            $qry = $conn->query("SELECT * FROM project_list WHERE manager_id='$filterid' order by name asc");
					}else{
            $qry = $conn->query("SELECT * FROM project_list $where  order by name asc");
					}
					while($row= $qry->fetch_assoc()):
						$trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
						unset($trans["\""], $trans["<"], $trans[">"], $trans["
											<h2"]);
						$desc = strtr(html_entity_decode($row['description']),$trans);
						$desc=str_replace(array("
												<li>","</li>"), array("",", "), $desc);
					?> <tr>
            <th class="text-center"> <?php echo $i++ ?> </th>
            <td>
              <p>
                <b> <?php echo ucwords($row['name']) ?> </b>
              </p>
            </td>
            <td>
              <b> <?php echo date("M d, Y",strtotime($row['start_date'])) ?> </b>
            </td>
            <td>
              <b> <?php echo date("M d, Y",strtotime($row['end_date'])) ?> </b>
            </td>
            <td class="text-center"> <?php
							  if($stat[$row['status']] =='Pending'){
							  	echo "
														<span class='badge badge-secondary'>{$stat[$row['status']]}</span>";
							  }elseif($stat[$row['status']] =='Started'){
							  	echo "
														<span class='badge badge-primary'>{$stat[$row['status']]}</span>";
							  }elseif($stat[$row['status']] =='In-Progress'){
							  	echo "
														<span class='badge badge-info'>{$stat[$row['status']]}</span>";
							  }elseif($stat[$row['status']] =='On-Hold'){
							  	echo "
														<span class='badge badge-warning'>{$stat[$row['status']]}</span>";
							  }elseif($stat[$row['status']] =='Over Due'){
							  	echo "
														<span class='badge badge-danger'>{$stat[$row['status']]}</span>";
							  }elseif($stat[$row['status']] =='Done'){
							  	echo "
														<span class='badge badge-success'>{$stat[$row['status']]}</span>";
							  }
							?> </td>
            <td class="text-center">
              <button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> Action </button>
              <div class="dropdown-menu" style="">
                <a class="dropdown-item view_project" href="./index.php?page=view_project&id=
																<?php echo $row['id'] ?>" data-id="
																<?php echo $row['id'] ?>">View </a>
                <div class="dropdown-divider"></div> <?php if($_SESSION['login_type'] != 3): ?> <a class="dropdown-item" href="./index.php?page=edit_project&id=
																<?php echo $row['id'] ?>">Edit </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item delete_project" href="javascript:void(0)" data-id="
																<?php echo $row['id'] ?>">Delete </a> <?php endif; ?>
              </div>
            </td>
          </tr> <?php endwhile; ?> </tbody>
      </table>
    </div>
  </div>
</div>
<style>
  table p {
    margin: unset !important;
  }

  table td {
    vertical-align: middle !important
  }
</style>
<script>
  $(document).ready(function() {
    $('#list').dataTable()
    $('.delete_project').click(function() {
      _conf("Are you sure to delete this project?", "delete_project", [$(this).attr('data-id')])
    })
  })

  function delete_project($id) {
    start_load()
    $.ajax({
      url: 'ajax.php?action=delete_project',
      method: 'POST',
      data: {
        id: $id
      },
      success: function(resp) {
        if (resp == 1) {
          alert_toast("Data successfully deleted", 'success')
          setTimeout(function() {
            location.reload()
          }, 1500)
        }
      }
    })
  }
</script>