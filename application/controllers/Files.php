<?php

class Files extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->library('image_lib');
    }

    private function doHeader() {

        $map = directory_map('./images/albuns');
        $header = array('directory' => $map);
        $this->load->view('header', $header);

        return NULL;
    }

    private function doViews($argument, $data) {

        $this->doHeader();
        $this->load->view($argument, $data);
        $this->load->view('footer');

        return NULL;
    }

    public function index() {

        $map = directory_map('./images/uploads');
        $data = array('directory' => $map);
        $this->doViews('index', $data);
    }

    public function fotos() {

        $map = directory_map('./images/uploads');
        $data = array('directory' => $map);
        $this->doViews('files_list', $data);
    }

    public function albuns() {

        $map = directory_map('./images/albuns');
        $data = array('directory' => $map);
        $this->doViews('files_album', $data);
    }

    public function files_albuns($dir_name) {

        $dir = './images/albuns/';
        $path = $dir . $dir_name;
        $map = directory_map($path);
        $data = array('directory' => $map, 'caminho' => $dir_name);
        $this->doViews('files_albuns', $data);
    }

    public function lixeira() {

        $map = directory_map('./images/excluded');
        $data = array('directory' => $map);
        $this->doViews('files_excluded', $data);
    }

    function do_upload() {

        $this->load->library('upload');

        $files = $_FILES;
        $cpt = count($_FILES['userfile']['name']);

        $dir = $this->input->post('diretorio');

        $dir_name = substr($dir, strpos($dir, "./images/albuns/") + 16);

        for ($i = 0; $i < $cpt; $i++) {
            $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
            $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
            $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
            $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
            $_FILES['userfile']['size'] = $files['userfile']['size'][$i];

            $this->upload->initialize($this->set_upload_options($dir));

            if (!$this->upload->do_upload('userfile')) {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('files_list', $error_upload);
            } else {
                $data = array('upload_data' => $this->upload->data());
                $this->load->view('files_list', $data);
            }
        }

        if ($dir === "./images/uploads/") {
            redirect('/files/fotos');
        } else {
            redirect('./files/files_albuns/' . $dir_name);
        }
    }

    private function set_upload_options($dir) {

        $config = array();
        $config['upload_path'] = $dir;
        $config['encrypt_name'] = TRUE;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 5000;
        $config['max_width'] = 1920;
        $config['max_height'] = 1080;
        $config['overwrite'] = FALSE;

        return $config;
    }

    function do_resize($file) {

        $config['image_library'] = 'gd2';
        $config['source_image'] = './images/uploads/' . $file;
        $config['quality'] = 100;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 140;
        $config['height'] = 140;

        $this->image_lib->initialize($config);

        if (!$this->image_lib->resize()) {
            echo $this->image_lib->display_errors('<p>', '</p>');
        }

        redirect('/files/fotos');
    }

    function do_mark($file) {

        $config = array();
        $config['image_library'] = 'gd2';
        $config['source_image'] = './images/uploads/' . $file;
        $config['wm_text'] = 'Copyright 2017 - Rafah Borges';
        $config['wm_type'] = 'text';
        $config['wm_font_size'] = '20';
        $config['wm_font_color'] = 'ffffff';
        $config['wm_vrt_alignment'] = 'bottom';
        $config['wm_hor_alignment'] = 'center';

        $this->image_lib->clear();
        $this->image_lib->initialize($config);

        if (!$this->image_lib->watermark()) {
            echo $this->image_lib->display_errors('<p>', '</p>');
        }

        redirect('/files/fotos');
    }

    function do_rename() {

        $path = './images/uploads/';
        $newname = $this->input->post('name');
        $oldname = $this->input->post('file');
        $dot = ".";
        $ext = pathinfo($oldname, PATHINFO_EXTENSION);
        rename($path . $oldname, $path . $newname . $dot . $ext);
        redirect('/files/fotos');
    }

    function do_trash() {

        $path = './images/uploads/';
        $file = $this->input->post('file');
        $oldpath = $this->input->post('caminho');
        $newpath = './images/excluded/';

        if ($path === $oldpath) {
            $basepath = './images/uploads/';
        } else {
            $basepath = './images/albuns/' . $oldpath . "/";
        }

        rename($basepath . $file, $newpath . $file);
        //unlink($basepath . $file);
        if ($basepath === "./images/uploads/") {
            redirect('/files/fotos');
        } else {
            redirect('./files/files_albuns/' . $oldpath);
        }
    }

    function do_undelete($file) {

        $oldpath = './images/excluded/';
        $newpath = './images/uploads/';
        rename($oldpath . $file, $newpath . $file);
        unlink('./images/excluded/' . $file);
        redirect('/files/lixeira');
    }

    function do_delete($file) {

        unlink('./images/excluded/' . $file);
        redirect('/files/lixeira');
    }

    function do_empty() {

        foreach (glob("./images/excluded/*") as $file) {
            if (is_dir($file)) {
                recursiveRemoveDirectory($file);
            } else {
                unlink($file);
            }
        }
        redirect('/files/lixeira');
    }

    function dir_create() {

        date_default_timezone_set("America/Sao_Paulo");
        $dirname = "album_" . date("dmY_His");
        $dir = './images/albuns/';

        $path = $dir . $dirname;

        if (!file_exists($path)) {
            mkdir($path, 0777, TRUE);
        }

        redirect('/files/albuns');
    }

    function dir_open($dir_name) {

        $dir = './images/albuns/';

        $path = $dir . $dir_name;

        $map = directory_map($path);
        $data = array('directory' => $map, 'caminho' => $dir_name);
        $this->load->view('header', array('error' => ' '));
        $this->load->view('files_albuns', $data);
        $this->load->view('footer');
    }

    function dir_rename() {

        $dir = './images/albuns/';
        $newdirname = $this->input->post('name');
        $olddirname = $this->input->post('file');

        if (!file_exists($dir . $newdirname)) {
            rename($dir . $olddirname, $dir . $newdirname);
        }

        redirect('/files/albuns');
    }

    function dir_delete($file) {

        $dir = './images/albuns/';
        $path = $dir . $file;
        rmdir($dir . $file);
        redirect('/files/albuns');
    }

}

?>