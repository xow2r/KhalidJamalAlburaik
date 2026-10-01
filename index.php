<?php 
include 'inc/db.php';
include 'inc/form.php';
include 'inc/select.php';
include 'inc/db_close.php';
?>

<?php include_once 'parts/header.php'; ?>



<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-body-tertiary">
 <div class="col-md-6 p-lg-5 mx-auto my-2"> 
  <img src="images/car.png" alt="" class="mb-4" width="50%" height="50%">
    <h1 class="display-3 fw-bold">أربح مع خالد</h1> 
    <h2 id="countdown"></h2>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.2/dist/confetti.browser.min.js"></script>
    <script src="js/JScript.js"></script>
    <h3 class="fw-normal text-muted mb-3">توزيع يخت خاص 2026 جديده كل اسبوع</h3> 
    <br>
    <h4 class="fw-normal text-muted mb-3">الشروط و الاحكام</h4> 
        <ul class="list-group list-group-flush">
          <li class="list-group-item">يجب للمشارك ان يكون بالغ و يملك رخصه قيادة سفن</li>
          <li class="list-group-item">متابعة حسابي في الانستقرام</li>
          <li class="list-group-item">ممنوع استخدام إيميل وهمي</li>
          <li class="list-group-item">السحب بيكون بشكل عشوائي 100%</li>
          <li class="list-group-item">بالتوفيق للجميع </li>
       </ul>
</div>
</div>


<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center ">
 <div class="col-md-6 p-lg-5 mx-auto my-5"> 

        <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <h3>الرجاء ادخل معلوماتك</h3>
  <div class="mb-3">
    <label for="firstName" class="form-label">الاسم الاول</label>
    <input type="text" name="firstName" class="form-control" id="firstName" value="<?php echo $firstName; ?>">
    <div class="form-text error"><?php echo $errors['firstNameError']; ?></div>
  </div>

    <div class="mb-3">
    <label for="lastName" class="form-label">الاسم الاخير</label>
    <input type="text" name="lastName" class="form-control" id="lastName" value="<?php echo $lastName; ?>" >
    <div class="form-text error"><?php echo $errors['lastNameError']; ?></div>
  </div>

    <div class="mb-3">
    <label for="email" class="form-label">البريد الالكتروني</label>
    <input type="text" name="email" class="form-control" id="email" value="<?php echo $email; ?>" >
    <div class="form-text error"><?php echo $errors['emailError']; ?></div>
  </div>

  <button type="submit" name="submit" value="send" class="btn btn-primary">ارسل</button>
        </form>
</div>
</div>


<div class="loder-con">
  <div id="loader">
    <canvas id="circularLoader" width="200" height="200"></canvas>
  </div>
</div>


<div class="d-grid gap-2 col-6 mx-auto my-5">
  <button type="button" id="winner" class="btn btn-success">
  اختيار الرابح
</button>
</div>


<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalLabel">الرابح في المسابقة</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="winnerBody">
        <p>جاري الاختيار...</p>
      </div>
    </div>
  </div>
</div>


<div id="cards" class="row mb-5 pb-5">

    <?php foreach ($users as $user): ?>

<div class="col-sm-6">
    <div class="card my-2 mx-5 bg-light">
        <div class="card-body ">

    <h5 class="card-title"><?php echo htmlspecialchars($user['firstName']) . ' ' . htmlspecialchars($user['lastName']); ?></h5>
    <p class="card-text"><?php echo htmlspecialchars($user['email']); ?></p>
      </div>
    </div>
</div>
<?php endforeach; ?>
</div>

<script src="js/loader.js?v=<?php echo time(); ?>"></script>

<?php include_once 'parts/footer.php'; ?>

//http://localhost/win/index.php