<section class="news_area p_100">
   <div class="container">
      <h3>Create Article</h3>
      <?= form_open_multipart('article/create') ?>

      <div class="form-group row">
         <label for="" class="col-sm-2 col-form-label">Preview</label>
         <br>
         <img alt="" id="imagePreview" height="150">
      </div>
      <div class="form-group row">
         <label for="" class="col-sm-2 col-form-label">Gambar</label>
         <br>
         <div class="col-sm-10">
            <input type="file" name="photo" id="image" accept="images/png, images/jpg, images/jpeg" onchange="previewImage()">
            <?= form_error('image', '<small class="form-text text-danger">', '</small>') ?>
         </div>
         <script>
            const previewImage = evt => {
               const [file] = image.files
               if (file) {
                  imagePreview.src = URL.createObjectURL(file)
               }
            }
         </script>
      </div>
      <div class="form-group row">
         <label for="title" class="col-sm-2 col-form-label"><span class="text-danger">*</span> Judul Artikel</label>
         <div class="col-sm-10">
            <?= form_input('title', set_value('title'), ['class' => 'form-control', 'id' => 'title', 'required' => true, 'autofocus' => true, 'autocomplete' => 'off']) ?>
            <?= form_error('title', '<small class="form-text text-danger">', '</small>') ?>
         </div>
      </div>

      <div class="form-group row">
         <label for="article" class="col-sm-2 col-form-label"><span class="text-danger">*</span> Konten</label>
         <div class="col-sm-10">
            <textarea name="content" id="editor" rows="10"><?= set_value('content') ?></textarea>
            <?= form_error('content', '<small class="form-text text-danger">', '</small>') ?>
         </div>
      </div>

      <div class="form-group row">
         <label for="category" class="col-sm-2 col-form-label"><span class="text-danger">*</span> Kategori</label>
         <select class="col-sm-10" id="id_category" name="id_category">
            <option value="">- Pilih -</option>
            <?php foreach ($category as $c) : ?>
               <option value="<?= $c->id ?>" <?= set_value('id_category') == $c->id ? 'selected' : ''  ?>><?= $c->category_name ?></option>
            <?php endforeach ?>
         </select>
         <div class="col-sm-2"></div>
         <div class="col-sm-10">
            <?= form_error('id_category', '<small class="form-text text-danger">', '</small>') ?>
         </div>
      </div>
      <div class="d-flex justify-content-center">
         <button type="submit" class="btn btn-primary" style="cursor: pointer;">Upload</button>
      </div>

      <?= form_close() ?>
   </div>
</section>

<script src="<?= base_url('assets\vendor\ckeditor5-build-classic\ckeditor.js') ?>"></script>
<script>
   ClassicEditor
      .create(document.querySelector('#editor'), {
         toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
         heading: {
            options: [{
                  model: 'paragraph',
                  title: 'Paragraph',
                  class: 'ck-heading_paragraph'
               },
               {
                  model: 'heading1',
                  view: 'h1',
                  title: 'Heading 1',
                  class: 'ck-heading_heading1'
               },
               {
                  model: 'heading2',
                  view: 'h2',
                  title: 'Heading 2',
                  class: 'ck-heading_heading2'
               }
            ]
         }
      })
      .catch(error => {
         console.error(error);
      });
</script>