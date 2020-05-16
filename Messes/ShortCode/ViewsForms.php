<?php
function formulaireMesse($atts)
{
    if (isset($_POST['gg'])) {
        $post = array(
            'post_content' => $_POST['content'],
            'post_title'   => $_POST['title']
        );
        //$id = wp_insert_post( $post, $wp_error );
        print_r($post);
    }
?>
    <form method="post">
        <input type="text" name="title">
        <input type="text" name="content">
        <input type="submit" name="gg">

        <div class="panel panel-default panel-body">
            <div class="box-body">
                <div class="form-group">
                    <div class="col-sm-2">
                        <label>Civilité</label>
                        <input type="text" id="example-email22" name="example-email22" class="form-control" placeholder="Email">
                    </div>
                </div>

                <div class="form-group">
                    <label for="simpleinput">Text</label>
                    <input type="text" id="simpleinput" class="form-control">
                </div>

                <div class="form-group">
                    <label for="example-email">Email</label>
                    <input type="email" id="example-email" name="example-email" class="form-control" placeholder="Email">
                </div>

                <div class="form-group">
                    <label for="example-password">Password</label>
                    <input type="password" id="example-password" class="form-control" value="password">
                </div>

                <div class="form-group">
                    <label for="example-palaceholder">Placeholder</label>
                    <input type="text" id="example-palaceholder" class="form-control" placeholder="placeholder">
                </div>

                <div class="form-group">
                    <label for="example-textarea">Text area</label>
                    <textarea class="form-control" id="example-textarea" rows="5"></textarea>
                </div>

                <div class="form-group">
                    <label for="example-readonly">Readonly</label>
                    <input type="text" id="example-readonly" class="form-control" readonly="" value="Readonly value">
                </div>

                <div class="form-group">
                    <label for="example-disable">Disabled</label>
                    <input type="text" class="form-control" id="example-disable" disabled="" value="Disabled value">
                </div>

                <div class="form-group">
                    <label for="example-static">Static control</label>
                    <input type="text" readonly class="form-control-plaintext" id="example-static" value="email@example.com">
                </div>

                <div class="form-group">
                    <label for="example-helping">Helping text</label>
                    <input type="text" id="example-helping" class="form-control" placeholder="Helping text">
                    <span class="help-block"><small>A block of help text that breaks onto a new line and may extend beyond one line.</small></span>
                </div>

                <div class="form-group">
                    <label for="example-select">Input Select</label>
                    <select class="form-control" id="example-select">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="example-multiselect">Multiple Select</label>
                    <select id="example-multiselect" multiple class="form-control">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="example-fileinput">Default file input</label>
                    <input type="file" id="example-fileinput" class="form-control-file">
                </div>

                <div class="form-group">
                    <label for="example-date">Date</label>
                    <input class="form-control" id="example-date" type="date" name="date">
                </div>

                <div class="form-group">
                    <label for="example-month">Month</label>
                    <input class="form-control" id="example-month" type="month" name="month">
                </div>

                <div class="form-group">
                    <label for="example-time">Time</label>
                    <input class="form-control" id="example-time" type="time" name="time">
                </div>

                <div class="form-group">
                    <label for="example-week">Week</label>
                    <input class="form-control" id="example-week" type="week" name="week">
                </div>

                <div class="form-group">
                    <label for="example-number">Number</label>
                    <input class="form-control" id="example-number" type="number" name="number">
                </div>
            </div>
        </div>
    </form>
<?php
}
//add_shortcode( 'formDemandeDeMesse', 'formulaireMesse' ); 
function formulaireMesseV2($atts)
{
    $id = 0;
    $txtcodePers = $_POST["txtcodePers"];
    $txtnom = $_POST["txtnom"];
    $txtdateMesse = $_POST["txtdateMesse"];
    $txtheureMesse = $_POST["txtheureMesse"];
    $txtphonePers = $_POST["txtphonePers"];
    $txtoffrande = $_POST["txtoffrande"];
    $txtadressePers = $_POST["txtadressePers"];
    $txttypeMesse = $_POST["txttypeMesse"];
    $txttypeMonnaie = $_POST["txttypeMonnaie"];

    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    global $wpdb;
    if (isset($_POST['btnEnregistrer'])) {
        $wpdb->insert(
            TBL_DEMANDE_DE_MESSES, //table
            array(
                'codePers' => $txtcodePers,
                'nom' => $txtnom,
                'dateMesse' => $txtdateMesse,
                'heureMesse' => $txtheureMesse,
                'phonePers' => $txtphonePers,
                'offrande' => $txtoffrande,
                'adressePers' => $txtadressePers,
                'typeMesse' => $txttypeMesse,
                'typeMonnaie' => $txttypeMonnaie
            ) //, //data
            //array('%s', '%s') //data format			
        );
        $id = $wpdb->insert_id;
        $message = 'Demande enregistree avec succes.';
        Tools::DialogPopUP($message);
        $message = Tools::ShowMessageBS($message, 'S');

        $txtcodePers = '';
        $txtnom = '';
        $txtdateMesse = '';
        $txtheureMesse = '';
        $txtphonePers = '';
        $txtoffrande = '';
        $txtadressePers = '';
        $txttypeMesse = '';
        $txttypeMonnaie = '';
    }
?>
    <!--
    <link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800' type='text/css'>
    <link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Raleway:300,200,100' type='text/css'>

    <link rel="stylesheet" href="<?php echo LINK_CURRENT_PLUGIN; ?>/styles/bootstrap/assets/dist/css/bootstrap.css">
-->

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo LINK_CURRENT_PLUGIN; ?>styles/CleanZone/js/bootstrap.switch/bootstrap-switch.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo LINK_CURRENT_PLUGIN; ?>styles/CleanZone/js/bootstrap.datetimepicker/css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo LINK_CURRENT_PLUGIN; ?>styles/CleanZone/js/jquery.select2/select2.css" />


    <!--<link rel="stylesheet" href="<?php echo LINK_CURRENT_PLUGIN; ?>styles/CleanZone/css/styleCopy.css" />-->
    <link rel="stylesheet" href="<?php echo LINK_CURRENT_PLUGIN; ?>styles/CleanZone/fonts/font-awesome-4/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo LINK_CURRENT_PLUGIN; ?>styles/CleanZone/css/pygments.css"><!-- -->

    <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">

        <?php if (isset($message)) {
            echo $message;
        } ?>


        <div class="box-body">

            <div class="form-group">

                <div class="col-sm-4">
                    <label for="txtcodePers">codePers</label>
                    <input type="text" id="txtcodePers" name="txtcodePers" parsley-trigger="change" required class="teststyle form-control" placeholder="codePers" value="<?php echo $txtcodePers; ?>">
                </div>

                <div class="col-sm-4">
                    <label for="txtnom">Nom</label>
                    <input type="text" id="txtnom" name="txtnom" parsley-trigger="change" required placeholder="nom" class="form-control" value="<?php echo $txtnom; ?>">
                </div>

                <div class="col-sm-4">
                    <label for="txtdateMesse">dateMesse</label>
                    <input type="date" id="txtdateMesse" name="txtdateMesse" parsley-trigger="change" required placeholder="dateMesse" class="form-control" value="<?php echo $txtdateMesse; ?>">
                </div>
                <div style="clear: both;"></div>
            </div>

            <div class="form-group">
                <div class="col-sm-4">
                    <label for="txtheureMesse">heureMesse</label>
                    <input type="time" id="txtheureMesse" name="txtheureMesse" parsley-trigger="change" required placeholder="heureMesse" class="form-control" value="<?php echo $txtheureMesse; ?>">
                </div>

                <div class="col-sm-4">
                    <label for="txtphonePers">phonePers</label>
                    <input type="tel" id="txtphonePers" name="txtphonePers" placeholder="phonePers" class="form-control" value="<?php echo $txtphonePers; ?>">
                </div>

                <div class="col-sm-4">
                    <label for="txtoffrande">offrande</label>
                    <input type="number" id="txtoffrande" name="txtoffrande" parsley-trigger="change" required placeholder="offrande" class="form-control" value="<?php echo $txtoffrande; ?>">
                </div>
                <div style="clear: both;"></div>
            </div>

            <div class="form-group">
                <div class="col-sm-4">
                    <label for="txtadressePers">adressePers</label>
                    <input type="text" id="txtadressePers" name="txtadressePers" placeholder="adressePers" class="form-control" value="<?php echo $txtadressePers; ?>">
                </div>

                <div class="col-sm-4">
                    <label for="txttypeMesse">typeMesse</label>
                    <input type="text" id="txttypeMesse" name="txttypeMesse" parsley-trigger="change" required placeholder="typeMesse" class="form-control" value="<?php echo $txttypeMesse; ?>">
                </div>

                <div class="col-sm-4">
                    <label for="txttypeMonnaie">typeMonnaie</label>
                    <select id="txttypeMonnaie" name="txttypeMonnaie" parsley-trigger="change" required class="form-control">
                        <option value="HT" <?php echo ($txttypeMonnaie == '$HT' || $txttypeMonnaie == 'HT') ? 'selected="selected"' : '' ?>>HT</option>
                        <option value="US" <?php echo ($txttypeMonnaie == '$US' || $txttypeMonnaie == 'US') ? 'selected="selected"' : '' ?>>US</option>
                    </select>
                </div>
                <div style="clear: both;"></div>
            </div>

            <div class="form-group">
                <button type="submit" name="btnEnregistrer" id="btnEnregistrer" class="button button-primary button-large">
                    Envorer
                </button>
                <div style="clear: both;"></div>
            </div>
        </div>
    </form>


    <script src="<?php echo LINK_CURRENT_PLUGIN; ?>styles/CleanZone/js/jquery.js"></script>
    <script src="<?php echo LINK_CURRENT_PLUGIN; ?>styles/CleanZone/js/jquery.select2/select2.min.js" type="text/javascript"></script>
    <script src="<?php echo LINK_CURRENT_PLUGIN; ?>styles/CleanZone/js/jquery.parsley/parsley.js" type="text/javascript"></script>
    <script src="<?php echo LINK_CURRENT_PLUGIN; ?>styles/CleanZone/js/bootstrap.slider/js/bootstrap-slider.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo LINK_CURRENT_PLUGIN; ?>styles/CleanZone/js/jquery.nanoscroller/jquery.nanoscroller.js"></script>
    <script type="text/javascript" src="<?php echo LINK_CURRENT_PLUGIN; ?>styles/CleanZone/js/jquery.nestable/jquery.nestable.js"></script>
    <script type="text/javascript" src="<?php echo LINK_CURRENT_PLUGIN; ?>styles/CleanZone/js/behaviour/general.js"></script>
    <script type="text/javascript" src="<?php echo LINK_CURRENT_PLUGIN; ?>styles/CleanZone/js/jquery.ui/jquery-ui.js"></script>
    <script type="text/javascript" src="<?php echo LINK_CURRENT_PLUGIN; ?>styles/CleanZone/js/bootstrap.switch/bootstrap-switch.min.js"></script>
    <script type="text/javascript" src="<?php echo LINK_CURRENT_PLUGIN; ?>styles/CleanZone/js/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

<?php
} // End  formulaireMesseV2($atts)
?>