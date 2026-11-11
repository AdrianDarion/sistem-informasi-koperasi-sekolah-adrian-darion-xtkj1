<?php
$basePath = pageBasePath();
$loginError = isLoggedIn() ? '' : takeFlash('login_error', '');
$loginUsername = isLoggedIn() ? '' : takeFlash('login_username', '');
?>
<header class="topbar">
    <div class="topbar-heading">
        <p class="eyebrow">SMK KRISTEN IMMANUEL PONTIANAK</p>
        <h1><?= e($pageTitle ?? 'Dashboard') ?></h1>
        <?php if (!empty($pageSubtitle)): ?>
            <p class="topbar-subtitle"><?= e($pageSubtitle) ?></p>
        <?php endif; ?>
    </div>

    <div class="topbar-actions">
        <?php if (isLoggedIn()): ?>
            <div class="topbar-user">
                <span class="user-dot"></span>
                <span><?= e($_SESSION['auth_user']['name'] ?? 'Admin Koperasi') ?></span>
            </div>
            <a class="btn btn-small btn-logout" href="<?= e($basePath) ?>logout.php">
                Keluar
            </a>
        <?php else: ?>
            <form class="topbar-login-form" method="POST" action="<?= e($basePath) ?>login.php" id="login">
                <input
                    type="text"
                    name="username"
                    value="<?= e($loginUsername) ?>"
                    placeholder="Username"
                    aria-label="Username"
                    autocomplete="username"
                    required
                >
                <input
                    type="password"
                    name="password"
                    placeholder="Password"
                    aria-label="Password"
                    autocomplete="current-password"
                    required
                >
                <button class="btn btn-small btn-primary" type="submit">Login</button>
                <?php if ($loginError !== ''): ?>
                    <span class="topbar-login-error"><?= e($loginError) ?></span>
                <?php endif; ?>
            </form>
        <?php endif; ?>
    </div>
</header>
