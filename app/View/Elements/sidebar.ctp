<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="sidebar-toggler-wrapper">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler">
                </div>
                <!-- END SIDEBAR TOGGLER BUTTON --> 
            </li>
            <?php if (AuthComponent::user()) { ?>
                <li>
                    <a href="javascript:;"> 
                        <i class="icon-home"></i>
                        <span class="title">Dashboard</span>
                        <span class="arrow "></span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="glyphicon glyphicon-user"></i>
                        <span class="title">Klanten</span>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="/clients/add">
                                Nieuwe klant toevoegen
                            </a>
                        </li>
                        	<?php if(AuthComponent::user('role_id')==1){?>
                        <li>
						
                            <a href="/clients/"> 
                                Alle klanten bekijken
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </li>
                <?php if (AuthComponent::user('role_id') == 1) { ?>
                    <li>
                        <a href="javascript:;">
                            <i class="glyphicon glyphicon-user"></i>
                            <span class="title">Colors</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="/homepage/add_color">
                                    Add Color
                                </a>
                            </li>
                            <li>
                                <a href="/homepage/all_colors"> 
                                    View All Colors
                                </a>
                            </li>
                        </ul>
                    </li> 
                    <li>
                        <a href="javascript:;">
                            <i class="glyphicon glyphicon-user"></i>
                            <span class="title">Vertegenwoordigers</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="/users/register">
                                    Voeg vertegenwoordiger
                                </a>
                            </li>
                            <li>
                                <a href="/users/"> 
                                    alle vertegenwoordiger
                                </a>
                            </li>
                        </ul>
                    </li> 
                     <li>
                        <a href="/ExcelFiles/">
                           <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                            <span class="title">Alle Excel-bestanden</span>
                            <span class="arrow "></span>
                        </a>
                    </li> 
                <?php } ?>
            <?php } ?>
            <!--   <li>
                  <a href="javascript:;">
                      <i class="icon-handbag"></i>
                      <span class="title">Categories</span>
                      <span class="arrow "></span>
                  </a>
              </li> -->
            <!-- <li>
                 <a href="javascript:;">
                     <i class="icon-settings"></i>
                     <span class="title">Categories</span>
                     <span class="arrow "></span>
                 </a>
                 <ul class="sub-menu">
                     <li>
                         <a href="/categories/add">
                             Add Category
                         </a>
                     </li>
                     <li>
                         <a href="/categories/">
                             View Categories 
                         </a>
                     </li> 
                 </ul>
             </li>
 
             <li>
                 <a href="javascript:;">
                     <i class="icon-settings"></i>
                     <span class="title">Sub-Categories</span>
                     <span class="arrow "></span>
                 </a>
                 <ul class="sub-menu">
                     <li>
                         <a href="/sub_categories/add">
                             Add Sub-Category
                         </a>
                     </li>
                     <li>
                         <a href="/sub_categories/">
                             View Sub-Categories
                         </a>
                     </li> 
                 </ul>
             </li>
             <li>
                 <a href="javascript:;">
                     <i class="icon-settings"></i>
                     <span class="title">Payment Plans</span>
                     <span class="arrow "></span>
                 </a>
                 <ul class="sub-menu">
                     <li>
                         <a href="/plans/add"> 
                             Add Plan
                         </a>
                     </li>
                     <li>
                         <a href="/plans/">
                             View Plans
                         </a>
                     </li> 
                 </ul>
             </li>
             <li>
                 <a href="javascript:;">
                     <i class="icon-settings"></i>
                     <span class="title">Advertisements</span>
                     <span class="arrow "></span>
                 </a>
                 <ul class="sub-menu">
                     <li>
                         <a href="/adds/add"> 
                             Add 
                         </a>
                     </li>
                     <li>
                         <a href="/adds/"> 
                             View Adds
                         </a>
                     </li> 
                 </ul>
             </li>
             <li>
                 <a href="javascript:;">
                     <i class="icon-settings"></i>
                     <span class="title">Messages</span>
                     <span class="arrow "></span>
                 </a>
                 <ul class="sub-menu">
                     <li>
                         <a href="/messages/composeMessage"> 
                             Compose  
                         </a>
                     </li>
                     <li>
                         <a href="/messages/">  
                             View All Messages
                         </a>
                     </li> 
                 </ul>
             </li>-->

        </ul> 
        <!-- END SIDEBAR MENU -->
    </div>
</div>
