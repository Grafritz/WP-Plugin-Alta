<?php
   
   //if ( ! class_exists( 'Tools' ) ) {
   //   require_once( LINK_CURRENT_PLUGIN . 'Tools/Tools.php' );
   //}

   //Tools::DialogPopUP('Test message');
   //$message = Tools::ShowMessageBS('Test message');
   //Tools::redirige('?page=page_list_demande');
    //print_r(LINK_CURRENT_PLUGIN);
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
     $message = 'Informations enregistree avec succes.';
     Tools::DialogPopUP($message);
     $message = Tools::ShowMessageBS($message);
     Tools::redirige('?page=messe_create&id='.$id);

   } else if (isset($_POST['btnUpdate'])) {
      $wpdb->update( TBL_DEMANDE_DE_MESSES, //table
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
         ), //data
         array('ID' => $id)//, //where
         //array('%s'), //data format
         //array('%s') //where format		
     );
     $message = 'Informations enregistree avec succes.';
     Tools::DialogPopUP($message);
     $message = Tools::ShowMessageBS($message, 'S');
     //Tools::redirige('?page=messe_create&id='.$id);

   } else if (isset($_POST['btnDelete'])) {
      $wpdb->query($wpdb->prepare('DELETE FROM '.TBL_DEMANDE_DE_MESSES.' WHERE ID=%s', $id));
      
     $message = 'Informations supprimee.';
     Tools::DialogPopUP($message);
     $message = Tools::ShowMessageBS($message, 'S');
     Tools::redirige('?page=page_list_demande');
   } else {
        $items = $wpdb->get_results($wpdb->prepare('SELECT * FROM ' . TBL_DEMANDE_DE_MESSES . ' WHERE ID=%s', $id));

        foreach ($items as $s) {
            $id = $s->ID;
            $txtcodePers = $s->codePers;
            $txtnom = $s->nom;
            $txtdateMesse = $s->dateMesse;
            $txtheureMesse = $s->heureMesse;
            $txtphonePers = $s->phonePers;
            $txtoffrande = $s->offrande;
            $txtadressePers = $s->adressePers;
            $txttypeMesse = $s->typeMesse;
            $txttypeMonnaie = $s->typeMonnaie;
        }
   }
    // print_r(LINK_CURRENT_PLUGIN);
    ?>

   <link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800' type='text/css'>
   <link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Raleway:300,200,100' type='text/css'>

   <link rel="stylesheet" href="<?php echo LINK_CURRENT_PLUGIN; ?>/styles/bootstrap/assets/dist/css/bootstrap.css">

   <!-- Bootstrap core CSS -->
   <link rel="stylesheet" type="text/css" href="<?php echo LINK_CURRENT_PLUGIN; ?>styles/CleanZone/js/bootstrap.switch/bootstrap-switch.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo LINK_CURRENT_PLUGIN; ?>styles/CleanZone/js/bootstrap.datetimepicker/css/bootstrap-datetimepicker.min.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo LINK_CURRENT_PLUGIN; ?>styles/CleanZone/js/jquery.select2/select2.css" />

   
   <link rel="stylesheet" href="<?php echo LINK_CURRENT_PLUGIN; ?>styles/CleanZone/css/styleCopy.css" />
   <link rel="stylesheet" href="<?php echo LINK_CURRENT_PLUGIN; ?>styles/CleanZone/fonts/font-awesome-4/css/font-awesome.min.css">
   <link rel="stylesheet" href="<?php echo LINK_CURRENT_PLUGIN; ?>styles/CleanZone/css/pygments.css">

    <div class="wrap">
       <link type="text/css" href="<?php echo LINK_CURRENT_PLUGIN; ?>/styles/bootstrap/assets/dist/css/bootstrap.css" rel="stylesheet" />

       <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
           <div id="poststuff">
               <div id="post-body" class="metabox-holder columns-2">

                   <div id="post-body-content" style="position: relative;">
                       <div class="page-head" style="padding:0px;">
                           <h1 class="">
                               <?php if ($id <= 0) { ?>
                                   Nouvelle
                               <?php } else if (isset($_GET['action']) && $_GET['action'] === 'del') { ?>
                                   Supprimer
                               <?php } else { ?>
                                   Modifier
                               <?php } ?>
                               Demande de messe</h1>
                       </div>
                       <?php if (isset($message)){
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

                           </div>

                       </div>
                   </div>

                   <div id="postbox-container-1" class="postbox-container">
                       <div id="side-sortables" class="meta-box-sortables ui-sortable">
                           <div id="submitdiv" class="postbox ">
                               <button type="button" class="handlediv" aria-expanded="true">
                                   <span class="screen-reader-text">Ouvrir/fermer la section Publier</span>
                                   <span class="toggle-indicator" aria-hidden="true"></span></button>
                               <h2 class="hndle ui-sortable-handle"><span>Publier</span></h2>
                               <div class="inside">
                                   <div class="submitbox" id="submitpost">

                                       <div id="minor-publishing">

                                           <div id="misc-publishing-actions"></div>
                                           <div class="clear"></div>
                                       </div>

                                       <div id="major-publishing-actions">
                                           <div id="delete-action">
                                               <a href="?page=page_list_demande" class="submitdelete deletion">Retour</a>
                                           </div>

                                           <div id="publishing-action">
                                               <span class="spinner"></span>
                                               <input name="original_publish" type="hidden" id="original_publish" value="Publier">
                                               <?php if ($id <= 0) { ?>
                                                   <button type="submit" name="btnEnregistrer" id="btnEnregistrer" class="button button-primary button-large">
                                                       Enregistrer
                                                   </button>
                                               <?php } else if (isset($_GET['action']) && $_GET['action'] === 'del') { ?>

                                                   <button type="submit" name="btnDelete" id="btnDelete" class="btn btn-danger button-large">
                                                       Supprimer
                                                   </button>
                                               <?php } else { ?>
                                                   <button type="submit" name="btnUpdate" id="btnUpdate" class="button button-primary button-large">
                                                       Mettre a jour
                                                   </button>
                                               <?php } ?>
                                           </div>
                                           <div class="clear"></div>
                                       </div>

                                   </div>
                               </div>
                           </div>

                       </div>
                   </div>

               </div>
               <br class="clear">
           </div>
       </form>
   </div>

   
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
   
   <style>
       .col-xs-1,
       .col-xs-2,
       .col-xs-3,
       .col-xs-4,
       .col-xs-5,
       .col-xs-6,
       .col-xs-7,
       .col-xs-8,
       .col-xs-9,
       .col-xs-10,
       .col-xs-11,
       .col-xs-12,
       .col-sm-1,
       .col-sm-2,
       .col-sm-3,
       .col-sm-4,
       .col-sm-5,
       .col-sm-6,
       .col-sm-7,
       .col-sm-8,
       .col-sm-9,
       .col-sm-10,
       .col-sm-11,
       .col-sm-12 {
           float: left;
       }
   </style>