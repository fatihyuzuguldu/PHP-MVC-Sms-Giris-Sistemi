<?php include "App/Views/_Component/meta.php";?>
<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
        <div class="d-flex align-items-center justify-content-center w-100">
            <div class="row justify-content-center w-100">
                <div class="col-md-12 col-lg-12 col-xxl-3">
                    <div class="card mb-0">
                        <div class="card-body">
                            <a href="../" class="text-nowrap w-100 logo-img text-center d-block mb-4">
                                <img src="../assets/images/logos/dark-logo.png" width="300" alt="">
                            </a>
                            <div class="mb-5 text-center">
                                <p>Kaydolmak için lütfen gerekli alanları doldurunuz. </p>
                            </div>
                            <form method="POST">
                                <div class="mb-3">
                                    <h4 class="font-weight-medium fs-3 mb-1">İsim Soyisim <span style="color:red">*</span>

                                    </h4>
                                    <input type="text" class="form-control" placeholder="İsim Soyisim" name="UserFullName" pattern="[A-Za-zğüşıöçĞÜŞİÖÇ\s]+" title="Sadece harfler kullanılabilir" required autofocus oninput="this.value = this.value.toUpperCase()">
                                </div>
                                <div class="mb-3">
                                    <h4 class="font-weight-medium fs-3 mb-1">Telefon Numarası <span style="color:red">*</span>
                                        <small class="text-muted">&nbsp; (546) 740-0000</small>
                                    </h4>
                                    <input type="text" class="form-control phone-inputmask" id="phone-mask" placeholder="Telefon Numarası" name="PhoneNumber" minlength="10" inputmode="text" required autofocus>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 py-8 mb-4">Kaydol</button>
                            </form>

                            <div class="d-flex align-items-center">
                                <p class="fs-4 mb-0 text-dark">Hesabın varmı?</p>
                                <a class="text-primary fw-medium ms-2" href="Login">Giriş Yap!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "App/Views/_Component/script.php";?>