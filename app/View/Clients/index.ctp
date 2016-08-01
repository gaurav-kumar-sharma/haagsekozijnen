<?php echo $this->Html->css('jquery.dataTables.min.css'); ?>
<?php echo $this->Html->script('jquery.dataTables.min.js'); ?> 
<style>
    input {
        border:1px solid !important;
    }
</style>
<div id='flashMessages'>
    <?php echo $this->Flash->render(); ?>  
</div>
<div class="portlet box blue-madison"> 
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-globe"></i>Alle Klanten Bekijken
        </div>
    </div>
    <div class="portlet-body">
        <div id="flashMessages">
            <?php echo $this->Session->flash(); ?>
        </div> 
        <table id="clients_table"class="table table-striped table-bordered table-hover">
            <thead>
                <tr> 
                    <th>Naam</th>
                    <th>Email</th>
                    <th>Phone</th>
                     <th>Ref. Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="4" class="dataTables_empty">Loading Data...</td>
                </tr>   
            </tbody> 
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#clients_table').dataTable({
            "bProcessing": false,
            "bServerSide": true,
            "sAjaxSource": "<?php echo $this->Html->Url(array('controller' => 'clients', 'action' => 'user_details')); ?>",
            "columns": [
                {"mData": "Client.naam"},
                {"mData": "Client.email"},
                {"mData": "Client.telephone"},
                {"mData": "Client.ref_number"},
                {"mData": "Client.id"}
            ],
        });
    });
</script>







