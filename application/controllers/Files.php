<?php

class Files extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->library('image_lib');
    }

    public function index() {

        $map = directory_map('./images/uploads');
        $data = array('directory' => $map);
        $this->load->view('header', array('error' => ' '));
        $this->load->view('index', $data);
        $this->load->view('footer');
    }

    public function teste() {

        $this->load->view('teste');
    }

    public function fotos() {

        $map = directory_map('./images/uploads');
        $data = array('directory' => $map);
        $this->load->view('header', array('error' => ' '));
        $this->load->view('files_list', $data);
        $this->load->view('footer');
    }

    public function albuns() {

        $map = directory_map('./images/uploads');
        $data = array('directory' => $map);
        $this->load->view('header', array('error' => ' '));
        $this->load->view('files_album', $data);
        $this->load->view('footer');
    }

    public function lixeira() {

        $map = directory_map('./images/excluded');
        $data = array('directory' => $map);
        $this->load->view('header', array('error' => ' '));
        $this->load->view('files_excluded', $data);
        $this->load->view('footer');
    }

    public function do_upload2() {

        /* $config['file_name']            = $new_name; */
        $config['upload_path'] = './images/uploads/';
        $config['encrypt_name'] = TRUE;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 5000;
        $config['max_width'] = 1920;
        $config['max_height'] = 1080;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('files_list', $error_upload);
        } else {
            $data = array('upload_data' => $this->upload->data());
            $this->load->view('files_list', $data);
        }
    }

    function do_upload() {

        $this->load->library('upload');

        $files = $_FILES;
        $cpt = count($_FILES['userfile']['name']);

        for ($i = 0; $i < $cpt; $i++) {
            $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
            $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
            $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
            $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
            $_FILES['userfile']['size'] = $files['userfile']['size'][$i];

            $this->upload->initialize($this->set_upload_options());
            $this->upload->do_upload();
        }

        redirect('/files/fotos');
    }

    private function set_upload_options() {

        $config = array();
        $config['upload_path'] = './images/uploads/';
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

        $config['image_library'] = 'gd2';
        $config['source_image'] = './images/uploads/' . $file;
        $config['wm_text'] = 'Copyright 2017 - Rafah Borges';
        $config['wm_type'] = 'text';
        $config['wm_font_size'] = '5';
        $config['wm_font_color'] = 'ffffff';
        $config['wm_vrt_alignment'] = 'bottom';
        $config['wm_hor_alignment'] = 'center';
        $config['wm_padding'] = '20';

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

    function do_trash($file) {

        $oldpath = './images/uploads/';
        $newpath = './images/excluded/';
        rename($oldpath . $file, $newpath . $file);
        unlink('./images/uploads/' . $file);
        redirect('/files/fotos');
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

}

?>