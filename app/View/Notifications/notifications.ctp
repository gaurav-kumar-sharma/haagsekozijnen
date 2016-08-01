<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<i class="icon-bell"></i>
					
					<?php echo count($allNotifications)?'<span class="badge badge-default">'.count($allNotifications).'</span>':''; ?> 
					</a>
					<ul class="dropdown-menu">
						<li class="external">
							<h3>You have <span class="bold"><?php echo count($allNotifications); ?> New</span> Messages</h3>
							<!--<a href="/Notifications/view_all">view all</a>-->
						</li> 
						<li>
							<div class="slimScrollDiv" style="position: relative; overflow: auto; width: auto; height: 275px;">
							   <ul class="dropdown-menu-list" style="height: 275px; overflow: auto; width: auto;" data-handle-color="#637283" data-initialized="1">
								<?php for($i=0;$i<count($allNotifications);$i++){ ?>
								<li>
									
									
									<span class="time"><?php echo $this->Time->niceShort($allNotifications[$i]['Notification']['created'])?> </span>
									
									<br>
									<a href="/ExcelFiles/index/<?php echo $allNotifications[$i]['Notification']['id']?> ">
									
									<?php echo $allNotifications[$i]['Notification']['message']?> 
									</a>
									<span class=""></span>
								</li>
								<?php }?>
							</ul>
							<!--<div class="slimScrollBar" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 160.904255319149px; background: rgb(99, 114, 131);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(234, 234, 234);"></div></div>
							-->
						</li>
					</ul>
 
