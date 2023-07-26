<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view('layout-b/head') ?>
    </head>
    <body>
        <div id="global-loader">
            <div class="whirly-loader"> </div>
        </div>
        <div class="main-wrapper">
            <?php $this->load->view('layout-b/header') ?>
            <?php $this->load->view('layout-b/navigation') ?>
            <div class="page-wrapper">
                <div class="content">
                    <div class="page-header">
                        <div class="page-title">
                            <h4><?= $title ?></h4>
                            <h6>Create <?= $title ?></h6>
                        </div>
                        <!-- <div class="page-btn">
                            <a href="https://dreamspos.dreamguystech.com/html/template/newcountry.html" class="btn btn-added">
                            <img src="https://dreamspos.dreamguystech.com/html/template/assets/img/icons/plus.svg" alt="img" class="me-2">Add <?= $title ?>
                            </a>
                        </div> -->
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <?php echo form_open_multipart($controller.'/insert'); ?>
                                    <div class="col-lg-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label>Nama <?= $title ?><span class="manitory">*</span></label>
                                            <input type="text" placeholder="Enter Name" name="name" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <button class="btn btn-submit me-2" type="submit">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view('layout-b/footer') ?>
    </body>
</html>