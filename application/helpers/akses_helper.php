<?php

function is_login()
{

    $ci = get_instance();

    if (!$ci->session->userdata('idSession')) {
        redirect(base_url('c_auth'));
    } else {
        $role = $ci->session->userdata('role');
        $segmen1 = $ci->uri->segment(1);
        $segmen2 = $ci->uri->segment(2);
    }
}
