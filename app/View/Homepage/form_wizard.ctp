<div class="row">
    <div class="col-md-12">
        <div id='flashMessages'>
        <?php echo $this->Flash->render() ?>  
    </div>
        <div class="portlet light bordered" id="form_wizard_1">
            <div class="portlet-title">
                <div class="caption">
                    <i class=" icon-layers font-red"></i>
                    <span class="caption-subject font-red bold uppercase"> Form Wizard -
                        <span class="step-title"> Step 1 </span>
                    </span>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-wizard">
                    <div class="form-body">
                        <div id="bar" class="progress progress-striped" role="progressbar">
                            <div class="progress-bar progress-bar-success"> </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">
                                <form action="/homepage/form_wizard" class="form-horizontal" id="submit_form" method="POST">
                                    <h3 class="block">Stel nieuw kozijn samen : 
                                    </h3>
                                    <h5>Maak je keuze :
                                    </h5>
                                    <div class="form-group">
                                        <label class="control-label col-md-3"><div class="checkbox left-checkbox">
                                                <label>
                                                    Kunststof
                                                </label>
                                            </div>
                                        </label>
                                        <div class="col-md-4">
                                            <div class="checkbox left-checkbox">
                                                <input name="choice" value="1" type="checkbox">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3"><div class="checkbox left-checkbox">
                                                <label>
                                                    Aluminium

                                                </label>
                                            </div>
                                        </label>
                                        <div class="col-md-4">
                                            <div class="checkbox left-checkbox">
                                                <input name="choice" value="2" type="checkbox">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3"><div class="checkbox left-checkbox">
                                                <label>
                                                    Hout

                                                </label>
                                            </div>
                                        </label>
                                        <div class="col-md-4">
                                            <div class="checkbox left-checkbox">
                                                <input name="choice" value="3" type="checkbox">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button class="btn btn-outline green button-next" style="submit"> Ga Verder
                                                </button>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
