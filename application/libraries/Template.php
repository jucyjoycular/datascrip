<?php

class Template

{

    protected $_ci;



    function __construct()

    {

        $this->_ci = &get_instance();
    }



    function loadViews($content, $data = NULL)

    {

        /*

     * */

        $data['header'] = $this->_ci->load->view('layouts/Header', $data, TRUE);

        $data['navbar'] = $this->_ci->load->view('layouts/Navbar', $data, TRUE);

        $data['jumbotron'] = $this->_ci->load->view('layouts/Jumbotron', $data, TRUE);

        $data['content'] = $this->_ci->load->view($content, $data, TRUE);

        $data['footer'] = $this->_ci->load->view('layouts/Footer', $data, TRUE);

        $data['js'] = $this->_ci->load->view('layouts/Js', $data, TRUE);



        $this->_ci->load->view('layouts/App', $data);
    }
}
