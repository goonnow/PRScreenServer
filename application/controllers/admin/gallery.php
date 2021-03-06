<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

Class gallery extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Album_Model');
    }

    function list_gallery() {
        $this->datatables->select('cover,name,albumid');
        $this->datatables->from('album_catagory_relation');
        $this->datatables->join('album_catagory', 'album_catagory.id=album_catagory_relation.catagoryid');
        $this->datatables->join('album', 'album_catagory_relation.albumid=album.id');
        $this->db->group_by("albumid");
        $this->datatables->edit_column('albumid', '<a href=javascript:galleryuploader("$1") >Edit</a> | <a href="#" onclick="return delete_gallery_link($2)">Delete</a>', 'name,albumid');
        $this->datatables->edit_column('cover', '<img src="'.base_url().'resources/gallery/$2/$1" class="thumbnail"/>', 'cover,name');
        $json = $this->datatables->generate('UTF8');
        //  print_r($json);
        echo $json;
    }

    function add_album() { //$_POST => name, catagoryID, cover<integer => index of picture that is selected to be cover pic>
        if ($_POST['name'] != '') {
            /// if ($_FILES['images']['name'][0] != '') { //if at least one image are uploaded
            $path = realpath(".") . '/resources/gallery/' . $_POST['name'];
            if (file_exists($path))
                echo 'Album name already existed';
            else {
                // $this->add_file();          
                /// Create Album's directory 
                
                mkdir($path);
                mkdir($path . "/" . "thumbnail");

                /// Upload Cover

                $cover = 'cover';
                $config['upload_path'] = $path.'/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '0';
                $config['max_width'] = '0';
                $config['max_height'] = '0';

                $this->load->library('upload', $config);
                $this->upload->do_upload('cover');

                $image_data = $this->upload->data();
                $filename = $image_data['file_name'];
                
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                $_POST['quantity'] = 0;
                //$_POST['cover'] = base_url() . "resources/gallery/" . $_POST['name'] . "/" . $filename; 
                $_POST['cover'] = $filename; 
                ////$_POST['cover'] that come from submit form
                //is index of image that is uploaded and selected
                //as cover thumbnail
                //$image_data = $this->upload->data();

                $this->createThumnail($path."/", $filename, $ext);


                $this->Album_Model->insert($_POST);
                //echo 'aaaa';
                redirect(base_url() . "welcome#gallery_page", 'refresh');
            }
        }
        //   }else
        //     echo 'no image uploaded';
        //}
        else {
            echo 'Album Name is empty';
        }
        //redirect(base_url().'index.php/admin/album/');
        //$this->index();
    }

    function add_file() {// อั�?�?ี�?�?ม�?เ�?ี�?ยว �?�?�?�?�?�?ลาส�?ี�?เอ�?
        $path = 'resources/album/' . $_POST['name'];
        mkdir($path);
        $config['upload_path'] = $path . '/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '0';
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        //                
        //print_r($_FILES['image']);
        //                echo '<br><br>';
        //                print_r($_FILES['image2']);
        $this->load->library('upload', $config);
        for ($i = 0; $i < count($_FILES['images']['name']); $i++) { //multiple file upload
            foreach ($_FILES['images'] as $key => $value) {
                $temp[$key] = $value[$i];
            }
            $_FILES['image'] = $temp;  //create parameter 'image' for each image that have been upload
            $this->upload->do_upload('image');
        }
    }

    function delete_album() {//$_POST => id
        //echo 'AAA : ' . $id;
        $id = $this->input->post('id');
        if ($id != '' && $id != null) {
            $row = $this->Album_Model->get_album_by_id($id);
            $path = 'resources/gallery/' . $row->Name;

            delete_files($path, TRUE);
            rmdir($path);

            $this->Album_Model->delete($id);
        }

        //redirect(base_url().'index.php/admin/album/');.
    }

    function edit_album_name() {//$_POST => id ,name
        //echo $_POST['id'];
        //rename('./image_album/AlbumTest', './image_album/AlbumTest');
        $row = $this->Album_Model->get_album_by_id($_POST['id']);
        rename('resources/album/' . $row->Name, 'resources/album/' . $_POST['name']);


        $this->Album_Model->edit($_POST);


        //redirect(base_url().'index.php/admin/album/');
    }

    function getImageInAlbum($album_name) {

        /// Real Path
        $album_name = urldecode($album_name);
        $real_path = realpath(".") . "/resources/gallery/" . $album_name;
        $url_path = base_url() . "/resources/gallery/" . $album_name;

        /// Images array
        $images = array();

        /// Traverse In album's directory
        $dh = opendir($real_path);
        while (false !== ($filename = readdir($dh))) {
            // $files[] = $filename;
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            if ($filename != "." && $filename != ".." && ($ext == 'jpg' || $ext == 'jpeg')) {
                // echo $url_path."/".$filename."<br>";
                $image = array(
                    'filename' => $filename,
                    'path' => $url_path . "/" . $filename,
                    'thumbnail' => $url_path . "/thumbnail/" . $filename
                );
                $images[] = $image;
            }
        }

        $result = array(
            'album_name' => $album_name,
            'path' => $url_path,
            'images' => $images
        );

        /// Return JSON encode
        echo json_encode($result);
    }

    function deleteImage($album, $filename) {

        $album = urldecode($album);

        $real_path = realpath(".") . "/resources/gallery/" . $album;

        $image = $real_path . "/" . $filename;
        $thumbnail = $real_path . "/thumbnail/" . $filename;
        unlink($image);
        unlink($thumbnail);
    }

    function createThumnail($path, $image) {
        $images = $path . $image ;
        $new_images = $path . "thumbnail/" . $image ;
        $width = 200; //*** Fix Width & Heigh (Autu caculate) ***//
        $size = GetimageSize($images);
        $height = round($width * $size[1] / $size[0]);
        $images_orig = ImageCreateFromJPEG($images);
        $photoX = ImagesX($images_orig);
        $photoY = ImagesY($images_orig);
        $images_fin = ImageCreateTrueColor($width, $height);
        ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width + 1, $height + 1, $photoX, $photoY);
        ImageJPEG($images_fin, $new_images);
        ImageDestroy($images_orig);
        ImageDestroy($images_fin);
    }

}

?>
