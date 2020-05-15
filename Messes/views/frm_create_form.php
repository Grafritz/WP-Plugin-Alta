   <?php
    print_r(LINK_BOOTSTRAP_CSS);

    $id = $_POST["id"];
    $name = $_POST["name"];
    //insert
    if (isset($_POST['insert'])) {
        global $wpdb;
        $table_name = $wpdb->prefix . "school";

        $wpdb->insert(
            $table_name, //table
            array('id' => $id, 'name' => $name), //data
            array('%s', '%s') //data format			
        );
        $message .= "School inserted";
    }
    ?>
   <div class="wrap">
       <link type="text/css" href="<?php echo LINK_BOOTSTRAP_CSS; ?>" rel="stylesheet" />
        <!--<link href="http://localhost/wordpress-5.4.1/wp-content/plugins/WP-Plugin-Alta/styles/bootstrap/assets/dist/css/bootstrap.css" rel="stylesheet">-->

       <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
           <div id="poststuff">
               <div id="post-body" class="metabox-holder columns-2">

                   <div id="post-body-content" style="position: relative;">
                       <h1 class="teststyle">Nouvelle Demande de messe</h1>
                       <?php if (isset($message)) : ?><div class="updated">
                               <p><?php echo $message; ?></p>
                           </div><?php endif; ?>
                       <div class="box-body">

                           <div class="form-group">

                               
                        <div class="col-sm-4">
                            <label for="txtcodePers">codePers</label>
                            <input type="text" id="txtcodePers" name="txtcodePers" class="teststyle form-control" placeholder="codePers">
                        </div>

                        <div class="col-sm-4">
                            <label for="txtnom">Nom</label>
                            <input type="text" id="txtnom" name="txtnom" placeholder="nom" class="form-control">
                        </div>

                        <div class="col-sm-4">
                            <label for="txtdateMesse">dateMesse</label>
                            <input type="date" id="txtdateMesse" name="txtdateMesse" placeholder="dateMesse" class="form-control">
                        </div>

                        <div class="col-sm-4">
                            <label for="txtheureMesse">heureMesse</label>
                            <input type="time" id="txtheureMesse" name="txtheureMesse" placeholder="heureMesse" class="form-control">
                        </div>

                        <div class="col-sm-4">
                            <label for="txtphonePers">phonePers</label>
                            <input type="tel" id="txtphonePers" name="txtphonePers" placeholder="phonePers" class="form-control">
                        </div>

                        <div class="col-sm-4">
                            <label for="txtoffrande">offrande</label>
                            <input type="number" id="txtoffrande" name="txtoffrande" placeholder="offrande" class="form-control">
                        </div>

                        <div class="col-sm-4">
                            <label for="txtadressePers">adressePers</label>
                            <input type="text" id="txtadressePers" name="txtadressePers" placeholder="adressePers" class="form-control">
                        </div>

                        <div class="col-sm-4">
                            <label for="txttypeMesse">typeMesse</label>
                            <input type="text" id="txttypeMesse" name="txttypeMesse" placeholder="typeMesse" class="form-control">
                        </div>

                        <div class="col-sm-4">
                            <label for="txttypeMonnaie">typeMonnaie</label>
                            <input type="text" id="txttypeMonnaie" name="txttypeMonnaie" placeholder="typeMonnaie" class="form-control">
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
                                               <a class="submitdelete deletion">Annuler</a>
                                           </div>

                                           <div id="publishing-action">
                                               <span class="spinner"></span>
                                               <input name="original_publish" type="hidden" id="original_publish" value="Publier">
                                               <button type="submit" name="publish" id="publish" class="button button-primary button-large">
                                                   Enregistrer
                                               </button>
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