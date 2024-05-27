<?php include "App/Views/_Component/meta.php";?>

<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
        <div class="d-flex align-items-center justify-content-center w-100">
            <div class="row justify-content-center w-100">
                <div class="col-md-8 col-lg-6 col-xxl-3">
                    <div class="card mb-0">
                        <div class="card-body pt-5">
                            <a href="../" class="text-nowrap w-100 logo-img text-center d-block mb-4">
                                <img src="../assets/images/logos/dark-logo.png" width="180" alt="">
                            </a>
                            <div class="mb-5 text-center">
                                <p>Hoşgeldiniz! </p>
                                <h5 class="fw-bolder"><?= $_SESSION["UserFullName"], "<br> 0",$_SESSION["UserPhone"] ?></h5>

                            </div>
                            <form method="POST">
                                <div class="mb-3">
                                    <p class="fw-bolder">Lütfen Telefonunuza gönderilen doğrulama kodunu giriniz.</p>

                                    <div class="auth-input-wrapper d-flex align-items-center justify-content-sm-between numeral-mask-wrapper">

                                        <input class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2" name="code1" type="tel" maxlength="1" inputmode="numeric" pattern="[0-9]" required oninput="goToNextInput(event, 'code2')" onkeydown="goToPreviousInput(event, 'code1', 'code1')" autocomplete="off" autofocus />
                                        <input class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2" name="code2" type="tel" maxlength="1" inputmode="numeric" pattern="[0-9]" required oninput="goToNextInput(event, 'code3')" onkeydown="goToPreviousInput(event, 'code1', 'code2')" autocomplete="off">
                                        <input class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2" name="code3" type="tel" maxlength="1" inputmode="numeric" pattern="[0-9]" required oninput="goToNextInput(event, 'code4')" onkeydown="goToPreviousInput(event, 'code2', 'code3')" autocomplete="off">
                                        <input class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2" name="code4" type="tel" maxlength="1" inputmode="numeric" pattern="[0-9]" required oninput="goToNextInput(event, 'code5')" onkeydown="goToPreviousInput(event, 'code3', 'code4')" autocomplete="off">
                                        <input class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2" name="code5" type="tel" maxlength="1" inputmode="numeric" pattern="[0-9]" required oninput="goToNextInput(event, 'code6')" onkeydown="goToPreviousInput(event, 'code4', 'code5')" autocomplete="off">
                                        <input class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2" name="code6" type="tel" maxlength="1" inputmode="numeric" pattern="[0-9]" required onkeydown="goToPreviousInput(event, 'code5', 'code6')" autocomplete="off">
                                    </div>
                                    <!-- Create a hidden field which is combined by 3 fields above -->
                                    <input type="hidden" name="otp" />
                                </div>
                                <button class="btn btn-primary d-grid w-100 mb-3">Doğrula</button>
                                <p class="fw-bolder">Kod:<?= $_SESSION["TwoFactorCode"] ?> <span style="color: red;">Sms API girdikten sonra bu kodu silin!</span></p>
                                <div class="text-center">
                                    Kod Gelmedimi
                                    <a href="Logout"> Geri Dön </a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function goToNextInput(event, nextInputName) {
        var currentInput = event.target;
        if (currentInput.value.length === currentInput.maxLength) {
            var nextInput = document.getElementsByName(nextInputName)[0];
            if (nextInput) {
                nextInput.focus();
            }
        }
    }

    function goToPreviousInput(event, previousInputName, currentInputName) {
        if (event.key === "Backspace" && event.target.value === "") {
            var previousInput = document.getElementsByName(previousInputName)[0];
            if (previousInput) {
                previousInput.focus();
            }
        } else if (event.key === "ArrowLeft" && event.target.selectionStart === 0) {
            var currentInput = document.getElementsByName(currentInputName)[0];
            if (currentInput) {
                currentInput.focus();
            }
        }
    }
</script>
<?php include "App/Views/_Component/script.php";?>