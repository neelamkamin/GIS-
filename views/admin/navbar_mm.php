<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo site_url("User/task_list") ?>">Task Module</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="<?php echo site_url("Admin/show_cost") ?>">Home</a></li>
        <li><a href="<?php echo site_url("Admin/show_category") ?>">Categogy of Fund</a></li>
        <li><a href="<?php echo site_url("User/extra") ?>">In_Charge List</a></li>
        <li><a href="<?php echo site_url('User') ?>">All Project List</a></li>
        <li><a href="<?php echo site_url('Admin/dashboard') ?>">Dashboard</a></li>
        <li><a href="<?php echo site_url("Login/updatePwd") ?>">A/C Setting</a></li>
    </ul>
    <?= form_open('user/search',['class'=>'form-inline my-2 my-lg-0','role'=>'search']); ?>
    <input type="text" name="query" class="form-control mr-sm-4" size="30" type="text" placeholder="Enter Project Name">
     <button class="btn btn-default" type="submit">Search</button>
    <?= form_close(); ?>
    <?= form_error('query',"<p class='navbar-text'>",'</p>') ?>

    <button class="btn btn-default" style="float:right"><a href="<?php echo site_url("login/logout") ?>">Logout</a>
    </button>

  </div>
</div>
</nav>