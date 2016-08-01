
<h3 class="page-title"> Alle Excel-bestanden
	<small>Excel-bestanden Listt</small>
</h3>
<style>
    input {
        border:1px solid !important;
    }
</style>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-gift"></i>Excel-bestanden List</div>
			</div>
			<div class="portlet-body">
				<div id='flashMessages'>
					<?php echo $this->Flash->render() ?>  
				</div>
				<div class="table-responsive">
					 <table id="ExcelList" class="table table-striped table-bordered table-hover">
					 <thead>
						<tr>
							<th>
								<?php echo __('klantnaam');?>
							</th>
							<th>
								<?php echo __('gemaakt door');?>
							</th>
							<th>
								<?php echo __('gemaakt op');?>
							</th>
							<th>
								 <?php echo __('Download');?>
							</th>
						</tr>
					  </thead>
					  <tbody>
						   <tr>
								<td colspan="4"><?php echo __('Loading '); ?></td>
							</tr>
					   </tbody>
					</table>
				</div>		
			</div>
		</div>
	</div>
</div>

<?php echo $this->Html->css('jquery.dataTables.min.css'); ?>
<?php echo $this->Html->script('jquery.dataTables.min.js'); ?> 

 <script type="text/javascript">
	
	
		$('#ExcelList').dataTable({
			"bProcessing": false,
			"bServerSide": true,
			"bDestroy": true,
			"aaSorting": [],
			"aoColumns": [
				{"mData":"Client.naam"},
				{"mData":"User.naam"},
				{"mData":"ExcelFile.created"},
				{"mData":"ExcelFile.filename"}
			],
			"sAjaxSource":"<?php echo $this->Html->Url(array('controller' => 'ExcelFiles', 'action' => 'get_files_table')); ?>"
		});

</script>
