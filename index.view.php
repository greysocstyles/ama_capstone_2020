<?php require_once 'includes/header.php'; ?>

    <?php if (isset($_SESSION['username']) && isset($_SESSION['account_type']) || isset($_SESSION['student_name'])) : ?>

        <?php if ($_SESSION['account_type'] == 'Admin') : ?>

            <?php require_once 'includes/nav-bar-admin.php'; ?>
            <?php require_once 'pages/admin_page.php'; ?>

        <?php elseif ($_SESSION['account_type'] == 'Student') : ?>

            <?php require_once 'includes/nav-bar-user.php'; ?>
            <?php require_once 'pages/student_page.php'; ?>

        <?php endif; ?>

    <?php else: ?>

        <div class="container-fluid">
            <div class="mt-5">
                <?php require_once 'forms/login.form.php'; ?>
            </div>
        </div>

    <?php endif; ?>

<?php require_once 'includes/footer.php'; ?>
