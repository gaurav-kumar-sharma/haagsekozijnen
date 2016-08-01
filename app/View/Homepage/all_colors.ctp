
<div class="page-head">
    <div class="page-title">
        <h1>Colors <small></h1>
    </div>
    <div id='flashMessages'>
        <?php echo $this->Flash->render() ?>  
    </div>
</div>
<div class="portlet box blue-madison">
    <div class="portlet-title" style="background-color: #67809F;color: white;">
        <div class="caption">
            <i class="fa fa-globe"></i>All Colors List
            
        </div>
        <div class="action">
            <?php echo $this->Html->link('Add Color',array('controller'=>'homepage','action'=>'add_color'),array('class'=>'btn btn-success input-circle pull-right')); ?>
        </div>
    </div>
    <div class="portlet-body">
        <div id="flashMessages">
            <?php echo $this->Session->flash(); ?>
        </div>
        <?php if (!empty($colors)) { ?>
            <table id="member_listing"class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Color Name</th>
                        <th>Color Code</th>
                        <th>Color</th> 
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($colors as $data) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $data['Color']['color_name']; ?>   
                            </td>
                            <td>
                              <?php echo $data['Color']['color_code']; ?>   
                            </td>
                            <td>
                                <div style="border:solid;border-color: <?php echo $data['Color']['color_code']; ?>">
                                </div>    
                            </td>
                            <td>
                              
                                <?php echo $this->Form->postLink('Delete', array('controller' => 'homepage', 'action' => 'delete_color', $data['Color']['id']), array('class' => ' input-circle btn btn-warning'),array('Are you sure to delete this color?')); ?> 
                            </td>
                        </tr>   
                    <?php } ?>
                </tbody>
            </table>
        <?php } else {
            ?>
            <h2 style="text-align: center;">No Color Added</h2>
        <?php } ?>
    </div>
</div>
<script type="text/javascript">


</script>
