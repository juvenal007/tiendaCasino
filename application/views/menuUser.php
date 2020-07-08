<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!isset($_SESSION)) {
    redirect(base_url('login'));
}
$user = $this->session->userdata('user');
if ($admin[0]->tipo != "USUARIO") {
    redirect(base_url('login'));
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <H1>USER</H1>
    </body>
</html>
