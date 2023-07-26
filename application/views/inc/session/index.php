<!DOCTYPE html>
<html lang="en" dir="/">

    <?php $this->load->view('layout/head') ?>

    <body>
        <div class="auth-layout-wrap" style="background-image: url(<?= base_url().'dist-assets/'?>images/photo-wide-4.jpg)">
            <div class="auth-content">
                <div class="card o-hidden">
                    <div class="row">
                        <div class="col-md-12">                                    
                            <div class="p-5 m-4">
                                <div class="text-center mb-4">
                                    <img src="<?= base_url().'dist-assets/'?>images/logo.png" alt=""/>
                                </div>

                                <?php echo form_open_multipart($controller.'/login'); ?>
                                    <div class="form-group">
                                        <label for="nip">Nomor Induk</label>
                                        <input class="form-control form-control-rounded" name="nip" placeholder="NIP Pendek BPK">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input class="form-control form-control-rounded" name="password" type="password" placeholder="password">
                                    </div>
                                    <button class="btn btn-rounded btn-primary btn-block mt-4" type="submit">Log In</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <?php $this->load->view('layout/custom') ?>
</html>