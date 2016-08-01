<div class="row"> 

    <div class="col-md-6 col-md-offset-3">
        <div class="row">
            <a href="/users/edit/<?php echo $user['User']['id']; ?>" class="btn btn-primary pull-right">Edit</a>
        </div>
        <div id='flashMessages'>
            <?php echo $this->Flash->render() ?>  
        </div>
       
        <div class="row">
            <label for="inputPassword3" class="col-sm-3 control-label">Name :
            </label>
            <div class="col-sm-9">
                <?php echo $user['User']['naam']; ?>
            </div>
        </div>
        <div class="row">
            <label for="inputPassword3" class="col-sm-3 control-label">Email :
            </label>
            <div class="col-sm-9">
                <?php echo $user['User']['email']; ?>
            </div>
        </div>
        <div class="row">
            <label for="inputPassword3" class="col-sm-3 control-label">Phone :
            </label>
            <div class="col-sm-9">
                <?php echo $user['User']['phone']; ?>
            </div>
        </div>
        <div class="row">
            <label for="inputPassword3" class="col-sm-3 control-label">Address :
            </label>
            <div class="col-sm-9">
                <?php echo date('m-d-Y', strtotime($user['User']['address'])); ?>
            </div>
        </div>
    </div>
</div>
