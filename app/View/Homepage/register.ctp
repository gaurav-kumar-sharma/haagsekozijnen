<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.min.js"></script>
<script>
    $(function() {
        $("#datum").datepicker();
        $('#telphone').mask('06/9999999');
    });
</script>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div id='flashMessages'>
            <?php echo $this->Flash->render() ?>  
        </div>
        <form class="form-horizontal" method="post">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Datum :
                </label>

                <div class="col-sm-9">
                    <input  class="form-control" id="datum" required="true">

                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Titel :
                </label>
                <div class="col-sm-9">
                    <select class="form-control" required="true">
                        <option value="volvo">Dhr.</option>
                        <option value="saab">Mevr.</option>
                        <option value="mercedes">Fam.</option>
                    </select>
                </div>
            </div>
             <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Geslacht :
                </label>
                <div class="col-sm-9">
                    <select class="form-control" required="true">
                        <option value="volvo">heer</option>
                        <option value="saab">mevrouw</option>
                        <option value="mercedes">Familie</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Naam :
                </label>
                <div class="col-sm-9">
                    <input  class="form-control" id="inputPassword3" placeholder="Willems" required="true">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Straat :
                </label>
                <div class="col-sm-9">
                    <input  class="form-control" id="inputPassword3" placeholder="Dorpsstraat" required="true">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Nr:
                </label>
                <div class="col-sm-9">
                    <input  class="form-control" id="inputPassword3" placeholder="107" required="true">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Postcode
                </label>
                <div class="col-sm-9">
                    <input  class="form-control" id="inputPassword3" placeholder="2798AC" required="true">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Woonplaats :
                </label>
                <div class="col-sm-9">
                    <input  class="form-control" id="inputPassword3" placeholder="Den Haag" required="true">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label" >Tel :
                </label>
                <div class="col-sm-9">
                    <input  class="form-control" id="telphone" type="text" value="06/" placeholder="06/251436" required="true">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Password</label>
                <div class="col-sm-9">
                    <input  class="form-control" id="inputPassword3" type="password" placeholder="Password" required="true">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">email : 
                </label>
                <div class="col-sm-9">
                    <input  class="form-control" id="inputPassword3" type="email" placeholder="Email" required="true">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Ref. nr. : 
                </label>
                <div class="col-sm-9">
                    <input  class="form-control" id="inputPassword3" type="text" placeholder="PKC001" value="<?php echo 'PK'.time(); ?>" required="true">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">adviseur: 

                </label>
                <div class="col-sm-9">

                    <select class="form-control" required="true">
                        <option value="volvo">Piet</option>
                        <option value="saab">Jan</option>
                        <option value="mercedes">Win</option>
                        <option value="volvo">Mark</option>
                        <option value="saab">Kees</option>
                        <option value="mercedes">Paul</option>
                        <option value="mercedes">Dirk</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-8 col-sm-3">
                    <button type="submit" class="btn btn-primary">Ga Verder</button>
                </div>
            </div>
        </form>
    </div>
</div>
