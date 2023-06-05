<?php
class Article extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->load->model('identity_model', 'identity', true);
      $this->load->model('banner_model', 'banner', true);
      $this->load->model('posting_model', 'posting', true);
      $this->load->model('category_model', 'category', true);
   }
   public function create()
   {

      $data['favicon']     = $this->identity->getIdentity();
      $data['title']       = 'Create Article';
      $data['banner']      = $this->banner->getBanner();
      $data['featured']    = $this->posting->getFeatured();
      $data['choice']      = $this->posting->getChoice();
      $data['popular']     = $this->posting->getMostPopular();
      $data['trending']    = $this->posting->getThread();
      $data['lastNews']    = $this->posting->getLastNews();
      $data['video_game']  = $this->posting->getVideoGames();
      $data['category']    = $this->category->getCategory();

      $data['page'] = 'add_article';

      $inputValidation = array(
         array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'required|regex_match[/^[ |\'a-zA-Z0-9]{6,}$/]',
            'errors' => array(
               'regex_match' => '%s must be a minimum of 6 characters and alpha characters',
            ),
         ),
         array(
            'field' => 'content',
            'label' => 'Content',
            'rules' => 'required',
         ),
         array(
            'field' => 'id_category',
            'label' => 'Category',
            'rules' => 'required',
         ),
      );
      $this->form_validation->set_rules($inputValidation);
      if ($this->form_validation->run() == FALSE) {
         $this->load->view('front/layouts/app', $data);
      } else {
         $data = $this->input->post();
         if (!empty($_FILES['photo']['name'])) {
            $upload = $this->posting->uploadImage();
            $this->_create_thumbs($upload);
            $data['photo'] = $upload;
         }
         $data['is_active'] = 'N';
         $data['featured'] = 'N';
         $data['choice'] = 'N';
         $data['thread'] = 'N';
         $insertUser = $this->posting->create($data);
         if ($insertUser == false) {
            $this->session->set_flashdata('message', "create posting failed someting wrong");
            return redirect('/article/create');
         }
         $this->session->set_flashdata('message', "craete posting success");
         return redirect('/');
      }
   }

   public function _create_thumbs($file_name)
   {
      $config = [
         // Large Image
         [
            'image_library'   => 'GD2',
            'source_image'      => './images/posting/' . $file_name,
            'maintain_ratio'   => TRUE,
            'width'            => 770,
            'height'            => 450,
            'new_image'         => './images/posting/large/' . $file_name
         ],
         // Medium Image
         [
            'image_library'   => 'GD2',
            'source_image'      => './images/posting/' . $file_name,
            'maintain_ratio'   => FALSE,
            'width'            => 300,
            'height'            => 188,
            'new_image'         => './images/posting/medium/' . $file_name
         ],
         // Small Image
         [
            'image_library'   => 'GD2',
            'source_image'      => './images/posting/' . $file_name,
            'maintain_ratio'   => FALSE,
            'width'            => 270,
            'height'            => 169,
            'new_image'         => './images/posting/small/' . $file_name
         ],
         // XSmall Image
         [
            'image_library'   => 'GD2',
            'source_image'      => './images/posting/' . $file_name,
            'maintain_ratio'   => FALSE,
            'width'            => 170,
            'height'            => 100,
            'new_image'         => './images/posting/xsmall/' . $file_name
         ],
      ];

      $this->load->library('image_lib', $config[0]);

      foreach ($config as $item) {
         $this->image_lib->initialize($item);

         if (!$this->image_lib->resize()) {
            return false;
         }

         $this->image_lib->clear();
      }

      return true;
   }
}
