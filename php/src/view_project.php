<?php
include 'includes/config.php';
$stat = array("Pending","Started","In-Progress","On-Hold","Over Due","Done");
$qry = $conn->query("SELECT * FROM project_list where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
$manager = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM users where id = $manager_id");
$manager = $manager->num_rows > 0 ? $manager->fetch_array() : array();
?> <div class="col-lg-12">
  <div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
      <h6 class="m-0 font-weight-bold text-primary">Project Information</h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse show" id="collapseCardExample">
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <div class="callout callout-info">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-sm-6">
                    <dl>
                      <dt>
                        <b class="border-primary">Project Name</b>
                      </dt>
                      <dd> <?php echo ucwords($name) ?> </dd>
                      <dt>
                        <b class="border-primary">Description</b>
                      </dt>
                      <dd> <?php echo html_entity_decode($description) ?> </dd>
                    </dl>
                  </div>
                  <div class="col-md-6">
                    <dl>
                      <dt>
                        <b class="border-primary">Start Date</b>
                      </dt>
                      <dd> <?php echo date("F d, Y",strtotime($start_date)) ?> </dd>
                    </dl>
                    <dl>
                      <dt>
                        <b class="border-primary">End Date</b>
                      </dt>
                      <dd> <?php echo date("F d, Y",strtotime($end_date)) ?> </dd>
                    </dl>
                    <dl>
                      <dt>
                        <b class="border-primary">Status</b>
                      </dt>
                      <dd> <?php
											if($stat[$status] =='Pending'){
												echo "
												<span class='badge badge-secondary'>{$stat[$status]}</span>";
											}elseif($stat[$status] =='Started'){
												echo "
												<span class='badge badge-primary'>{$stat[$status]}</span>";
											}elseif($stat[$status] =='In-Progress'){
												echo "
												<span class='badge badge-info'>{$stat[$status]}</span>";
											}elseif($stat[$status] =='On-Hold'){
												echo "
												<span class='badge badge-warning'>{$stat[$status]}</span>";
											}elseif($stat[$status] =='Over Due'){
												echo "
												<span class='badge badge-danger'>{$stat[$status]}</span>";
											}elseif($stat[$status] =='Done'){
												echo "
												<span class='badge badge-success'>{$stat[$status]}</span>";
											}
											?> </dd>
                    </dl>
                    <dl>
                      <dt>
                        <b class="border-primary">Project Manager</b>
                      </dt>
                      <dd> <?php if(isset($manager['id'])) : ?> <div class="d-flex align-items-center mt-1">
                          <b> <?php echo ucwords($manager['name']) ?> </b>
                        </div> <?php else: ?> <small>
                          <i>Manager Deleted from Database</i>
                        </small> <?php endif; ?> </dd>
                    </dl>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-8"></div>
    <div class="col-md-4">
      <div class="card shadow mb-4">
        <!-- Card Header - Accordion -->
        <a href="#collapseTeamMembers" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseTeamMembers">
          <h6 class="m-0 font-weight-bold text-primary">Team Member/s:</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse show" id="collapseTeamMembers">
          <div class="card-body">
            <ul class="users-list clearfix"> <?php 
							if(!empty($user_ids)):
								$members = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM users where id in ($user_ids) order by concat(firstname,' ',lastname) asc");
								while($row=$members->fetch_assoc()):
							?> <li>
                <a class="users-list-name" href="javascript:void(0)"> <?php echo ucwords($row['name']) ?> </a>
                <!-- <span class="users-list-date">Today</span> -->
              </li> <?php 
								endwhile;
							endif;
							?> </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>