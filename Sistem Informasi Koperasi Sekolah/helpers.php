<?php
// Fungsi umum yang dipakai halaman dan action.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function e($value): string
{
    return htmlspecialchars((string) ($value ?? ''), ENT_QUOTES, 'UTF-8');
}

function requestText(array $request, string $key): string
{
    $value = $request[$key] ?? '';
    return is_scalar($value) ? trim((string) $value) : '';
}

function requestStringArray($value): array
{
    if (!is_array($value)) {
        return [];
    }

    $items = [];
    foreach ($value as $item) {
        if (is_string($item) || is_numeric($item)) {
            $item = trim((string) $item);
            if ($item !== '' && !in_array($item, $items, true)) {
                $items[] = $item;
            }
        }
    }

    return $items;
}

function isValidDateValue(string $value): bool
{
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
        return false;
    }

    $parts = explode('-', $value);
    return checkdate((int) $parts[1], (int) $parts[2], (int) $parts[0]);
}

function flashRedirect(string $url, array $errors = [], array $old = [], string $success = ''): void
{
    if ($errors) {
        $_SESSION['errors'] = $errors;
    }
    if ($old) {
        $_SESSION['old'] = $old;
    }
    if ($success !== '') {
        $_SESSION['success'] = $success;
    }

    header('Location: ' . $url);
    exit;
}

function takeFlash(string $key, $default = [])
{
    $value = $_SESSION[$key] ?? $default;
    unset($_SESSION[$key]);
    return $value;
}

function pageBasePath(): string
{
    return strpos($_SERVER['PHP_SELF'] ?? '', '/pages/') !== false ? '../../' : '';
}

function isLoggedIn(): bool
{
    return isset($_SESSION['auth_user']) && is_array($_SESSION['auth_user']);
}

function appRootPath(): string
{
    $scriptPath = str_replace('\\', '/', $_SERVER['PHP_SELF'] ?? '');

    if (strpos($scriptPath, '/pages/') !== false || strpos($scriptPath, '/actions/') !== false) {
        return '../../';
    }

    return '';
}

