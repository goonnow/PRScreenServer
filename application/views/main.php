<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>PR Screen Management System</title>
        <?php $this->load->view('header'); ?>
        <script src="<?php echo base_url(); ?>js/AlbumUploader.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/editResource.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/fetchDataFromDataTable.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/addResource.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/previewImage.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/fileuploader.js" type="text/javascript"></script>


        <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>styles/dataTable.css" />
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>styles/fileuploader/fileuploader.css" />
        <script type="text/javascript">
            var base_url = 'http://localhost/PRScreenServer/' ;
            
            /// Set on AlbumUploader.js
            var galleryuploader = null;
   
        
            
            
          
        </script>

    </head>
    <body>

        <div class="wrapper">

            <div class="main_content">
                <div class="page">
                    <div id="login_form">
                        Hi,Pattarawat <a href="#"><img src="<?php echo base_url(); ?>styles/images/icons/logout.png" width="20" height="20" style="vertical-align: bottom;"/> </a>
                    </div>

                    <div>
                        <ul id="menu">
                            <li class="menu">
                                <a href="#" class="billboard_link">
                                    <img src="<?php echo base_url(); ?>styles/images/Menu/Billboard.png" class="menu_icon"/>
                                    <div class="menu_description">
                                        Billboard
                                    </div>
                                </a>
                            </li>
                            <li class="menu">
                                <a href="#" class="marquee_link">
                                    <img src="<?php echo base_url(); ?>styles/images/Menu/Marquee.png" class="menu_icon"/>
                                    <div class="menu_description">
                                        Marquee Text
                                    </div>
                                </a>
                            </li>
                            <li class="menu">
                                <a href="#" class="news_page_link">
                                    <img src="<?php echo base_url(); ?>styles/images/Menu/News.png" class="menu_icon"/>
                                    <div class="menu_description">
                                        News
                                    </div>
                                </a>
                            </li>
                            <li class="menu">
                                <a href="#" class="about_fac_link">
                                    <img src="<?php echo base_url(); ?>styles/images/Menu/AboutFac.png" class="menu_icon"/>
                                    <div class="menu_description">
                                        About Faculty
                                    </div>
                                </a>
                            </li>
                            <li class="menu"><a href="#" class="location_link">
                                    <img src="<?php echo base_url(); ?>styles/images/Menu/Location.png" class="menu_icon"/>
                                    <div class="menu_description">
                                        Location
                                    </div>
                                </a>
                            </li>
                            <li class="menu"><a href="#" class="guestbook_link">
                                    <img src="<?php echo base_url(); ?>styles/images/Menu/GuestBook.png" class="menu_icon"/>
                                    <div class="menu_description">
                                        Guestbook
                                    </div>
                                </a>
                            </li>
                            <li class="menu"><a href="#" class="gallery_link">
                                    <img src="<?php echo base_url(); ?>styles/images/Menu/Gallery.png" class="menu_icon"/>
                                    <div class="menu_description">
                                        Gallery
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="page" id="billboard_page">
                    <div class="header_1">
                        Manage Billboard Content
                        <a href="#" id="add_billboard_link">
                            <img src="<?php echo base_url(); ?>/styles/images/add-icon.png" class="add_icon"/>    
                        </a>
                    </div>

                    <?php $this->load->view('billboard/billboard_table') ?>


                </div>
                <div class="page" id="gallery_page">
                    <div class="header_1">
                        Manage Gallery Content
                        <a href="#" id="add_gallery_link">
                            <img src="<?php echo base_url(); ?>/styles/images/add-icon.png" class="add_icon"/>    
                        </a>
                        <a href="#" id="uploader">
                            Uploader
                        </a>
                    </div>
                    <?php $this->load->view('gallery/gallery_table') ?>
                </div>
                <div class="page" id="marquee_page">
                    <div class="header_1">
                        Manage Marquee Text
                        <a href="#" id="add_marquee_link">
                            <img src="<?php echo base_url(); ?>/styles/images/add-icon.png" class="add_icon"/>    
                        </a>
                    </div>
                    <?php $this->load->view('marqueetext/marqueetext_table') ?>
                </div>
                <div class="page" id="news_page">
                    <div class="header_1">
                        Manage News Content
                        <a href="#" id="add_news_link">
                            <img src="<?php echo base_url(); ?>/styles/images/add-icon.png" class="add_icon"/>    
                        </a>
                    </div>
                    <?php $this->load->view('news/news_table') ?>
                </div>
                <div class="page" id="location_page">
                    <div class="header_1">
                        Manage Location Content
                        <a href="#" id="add_location_link">
                            <img src="<?php echo base_url(); ?>/styles/images/add-icon.png" class="add_icon"/>    
                        </a>
                    </div>
                    <?php $this->load->view('location/location_table') ?>
                </div>
                <div class="page" id="guestbook_page">
                    <div class="header_1">
                        Manage Guestbook Content

                    </div>
                    <?php $this->load->view('guestbook/guestbook_table') ?>
                </div>

                <div class="page" id="about_fac_page">
                    <div class="header_1">
                        Manage About Faculty Content 
                        <a href="#" id="add_about_fac_link">
                            <img src="<?php echo base_url(); ?>/styles/images/add-icon.png" class="add_icon"/>    
                        </a>
                    </div>

                    <?php
                    $this->load->view('aboutfac/aboutfac_table');
                    ?>
                </div>
            </div>

            <ul id="small_menu_panel">
                <li class="small_menu">
                    <a href="#" class="billboard_link">
                        <img src="<?php echo base_url(); ?>styles/images/Menu/Billboard.png" width="50" height="50" class="menu_icon" />
                    </a>
                </li>
                <li class="small_menu">
                    <a href="#" class="marquee_link">
                        <img src="<?php echo base_url(); ?>styles/images/Menu/Marquee.png" width="50" height="50" class="menu_icon" />
                    </a>
                </li>
                <li class="small_menu">
                    <a href="#" class="news_page_link">
                        <img src="<?php echo base_url(); ?>styles/images/Menu/News.png" width="50" height="50" class="menu_icon" />
                    </a>
                </li>
                <li class="small_menu">
                    <a href="#" class="about_fac_link">
                        <img src="<?php echo base_url(); ?>styles/images/Menu/AboutFac.png" width="50" height="50" class="menu_icon"/>
                    </a>
                </li>
                <li class="small_menu">
                    <a href="#" class="location_link">
                        <img src="<?php echo base_url(); ?>styles/images/Menu/Location.png" width="50" height="50" class="menu_icon"/>
                    </a>
                </li>
                <li class="small_menu">
                    <a href="#" class="guestbook_link">
                        <img src="<?php echo base_url(); ?>styles/images/Menu/GuestBook.png" width="50" height="50" class="menu_icon"/>
                    </a>
                </li>
                <li class="small_menu">
                    <a href="#" class="gallery_link">
                        <img src="<?php echo base_url(); ?>styles/images/Menu/Gallery.png" width="50" height="50" class="menu_icon"/>
                    </a>
                </li>
            </ul>

        </div>


    </div>

</div>

<?php
$this->load->view('gallery/gallery_upload');
$this->load->view('gallery/add_gallery');
$this->load->view('billboard/add_billboard');
$this->load->view('billboard/edit_billboard');
$this->load->view('news/add_news');
$this->load->view('news/edit_news');
$this->load->view('location/add_location');
$this->load->view('location/edit_location');
$this->load->view('aboutfac/add_aboutfac');
$this->load->view('aboutfac/edit_aboutfac');
$this->load->view('marqueetext/add_marqueetext');
$this->load->view('marqueetext/edit_marqueetext');
$this->load->view('footer');
?>
</body>

</div>


</body>
</html>
