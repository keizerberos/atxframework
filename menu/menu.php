<?php
session_start();
include $_SESSION['atx_includes'];

$ctrl = new TableSet();	

$mod = $ctrl->getJsonQuery ( "select m.*,m.cod_mgrupo 'grupo'  from modulos m order by m.ord");
$grp = $ctrl->getJsonQuery ( "select g.*,g.cod_marea 'area' from mgrupos g order by g.ord");
$area = $ctrl->getJsonQuery ( "select a.* from marea a order by a.ord");
$dat['area'] = $area;
$dat['mod'] = $mod;
$dat['grp'] = $grp;

echo json_encode ( $dat );

?>