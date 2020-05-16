   <?php
    //print_r(LINK_BOOTSTRAP_CSS);
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
    $isInsert == true;
    // Verification Isert or Update
    $isInsert = ($id <= 0) ? false : true;
    //echo ('isInsert: ' . $id . ' ' . $isInsert);

    //insert
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
        $message .= "Data inserted " . $txtnom;
    } else if (isset($_POST['btnUpdate'])) {
       
        $wpdb->update(TBL_DEMANDE_DE_MESSES, //table
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
            array('ID' => $id), //where
            //array('%s'), //data format
            //array('%s') //where format		
        );
        $message .= "Data Update " . $txtnom;

    } else if (isset($_POST['btnDelete'])) {
        //$wpdb->query($wpdb->prepare("DELETE FROM '.TBL_DEMANDE_DE_MESSES.' WHERE ID=%s", $id));
        wp_redirect( esc_url_raw('?page=messe_create') );
        exit;
    } else {
        $items = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.TBL_DEMANDE_DE_MESSES.' WHERE ID=%s', $id));

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
    ?>
   <div class="wrap">
       <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/WP-Plugin-Alta/styles/bootstrap/assets/dist/css/bootstrap.css" rel="stylesheet" />

       <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
           <div id="poststuff">
               <div id="post-body" class="metabox-holder columns-2">

                   <div id="post-body-content" style="position: relative;">
                       <h1 class="">Nouvelle Demande de messe</h1>
                       <?php if (isset($message)) : ?>
                           <div class="updated">
                               <p><?php echo $message; ?></p>
                           </div><?php endif; ?>

                       <div class="box-body">

                           <div class="form-group">

                               <div class="col-sm-4">
                                   <label for="txtcodePers">codePers</label>
                                   <input type="text" id="txtcodePers" name="txtcodePers" class="teststyle form-control" placeholder="codePers"
                                   value="<?php echo $txtcodePers; ?>" >
                               </div>

                               <div class="col-sm-4">
                                   <label for="txtnom">Nom</label>
                                   <input type="text" id="txtnom" name="txtnom" placeholder="nom" class="form-control"
                                   value="<?php echo $txtnom; ?>" >
                               </div>

                               <div class="col-sm-4">
                                   <label for="txtdateMesse">dateMesse</label>
                                   <input type="date" id="txtdateMesse" name="txtdateMesse" placeholder="dateMesse" class="form-control"
                                   value="<?php echo $txtdateMesse; ?>" >
                               </div>

                               <div class="col-sm-4">
                                   <label for="txtheureMesse">heureMesse</label>
                                   <input type="time" id="txtheureMesse" name="txtheureMesse" placeholder="heureMesse" class="form-control"
                                   value="<?php echo $txtheureMesse; ?>" >
                               </div>

                               <div class="col-sm-4">
                                   <label for="txtphonePers">phonePers</label>
                                   <input type="tel" id="txtphonePers" name="txtphonePers" placeholder="phonePers" class="form-control"
                                   value="<?php echo $txtphonePers; ?>" >
                               </div>

                               <div class="col-sm-4">
                                   <label for="txtoffrande">offrande</label>
                                   <input type="number" id="txtoffrande" name="txtoffrande" placeholder="offrande" class="form-control"
                                   value="<?php echo $txtoffrande; ?>" >
                               </div>

                               <div class="col-sm-4">
                                   <label for="txtadressePers">adressePers</label>
                                   <input type="text" id="txtadressePers" name="txtadressePers" placeholder="adressePers" class="form-control"
                                   value="<?php echo $txtadressePers; ?>" >
                               </div>

                               <div class="col-sm-4">
                                   <label for="txttypeMesse">typeMesse</label>
                                   <input type="text" id="txttypeMesse" name="txttypeMesse" placeholder="typeMesse" class="form-control"
                                   value="<?php echo $txttypeMesse; ?>" >
                               </div>

                               <div class="col-sm-4">
                                   <label for="txttypeMonnaie">typeMonnaie</label>
                                   <input type="text" id="txttypeMonnaie" name="txttypeMonnaie" placeholder="typeMonnaie" class="form-control"
                                   value="<?php echo $txttypeMonnaie; ?>" >
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
                                           <div id="minor-publishing-actions">
                                               <!--<div id="save-action">
                                                <input type="submit" name="save" id="save-post" value="Enregistrer le brouillon" class="button">
                                                <span class="spinner"></span>
                                            </div>-->
                                               <div class="clear"></div>
                                           </div>
                                           <div id="misc-publishing-actions"></div>
                                           <div class="clear"></div>
                                       </div>

                                       <div id="major-publishing-actions">
                                           <div id="delete-action">
                                               <a href="?page=page_list_demande" class="submitdelete deletion">Annuler</a>
                                           </div>

                                           <div id="publishing-action">
                                               <span class="spinner"></span>
                                               <input name="original_publish" type="hidden" id="original_publish" value="Publier">
                                               <?php if ($id <= 0) { ?>
                                                   <button type="submit" name="btnEnregistrer" id="btnEnregistrer" class="button button-primary button-large">
                                                       Enregistrer
                                                   </button>
                                               <?php } else if( isset($_GET['action']) && $_GET['action']==='del' ){ ?>

                                                   <button type="submit" name="btnDelete" id="btnDelete" class="btn btn-danger button-large">
                                                       Supprimer
                                                   </button>
                                                <?php }else{ ?>
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