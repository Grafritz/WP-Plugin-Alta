<?php

global $wpdb;
define('TBL_DEMANDE_DE_MESSES', $wpdb->prefix . 'DmdDeMesse');
define('TBL_CUSTOMERS', $wpdb->prefix . 'Customers');
define('CUST_COL_NAME', 'name');
define('CUST_COL_ADRESSE', 'address');
define('CUST_COL_CITY', 'city');


function createTableCustomer()
{
    /**
     * Si inexistante, on créée la table SQL "commissions" après l'activation du thème
     */
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $commissions_table_name = TBL_CUSTOMERS;//$wpdb->prefix . 'commissions';

    $commissions_sql = "CREATE TABLE IF NOT EXISTS $commissions_table_name (
        ID int(9) NOT NULL AUTO_INCREMENT,
        ".CUST_COL_NAME." varchar(20) NOT NULL,
        ".CUST_COL_ADRESSE." varchar(30) NOT NULL,
        ".CUST_COL_CITY." varchar(10) NOT NULL,
        PRIMARY KEY  (ID)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    dbDelta($commissions_sql);
}

function createTableDmdDeMesse()
{
    /**
     * Si inexistante, on créée la table SQL "commissions" après l'activation du thème
     */
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $table_name = TBL_DEMANDE_DE_MESSES;

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        ID int(9) NOT NULL AUTO_INCREMENT,
        `codePers` varchar(45) NOT NULL,
        `nom` varchar(1000) default NULL,
        `nomUser` varchar(45) default NULL,
        `dateMesse` date default NULL,
        `heureMesse` varchar(10) default NULL,
        `phonePers` varchar(45) default NULL,
        `offrande` int(10) unsigned default NULL,
        `adressePers` varchar(45) default NULL,
        `typeMesse` varchar(45) default NULL,
        `dateEnreg` date default NULL,
        `userModif` varchar(45) default NULL,
        `dateModif` date default NULL,
        `typeMonnaie` varchar(45) default NULL,
        `multiReservations` varchar(45) default NULL,
        `date1MultiReserv` date default NULL,
        `date2MultiReserv` date default NULL,
        PRIMARY KEY  (`ID`)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    dbDelta($sql);
}