<?php

/**
 * Subida de imágenes moderna (PHP 8.3, sin dependencias externas).
 * - Valida el tipo real con finfo (no confía en la extensión del cliente)
 * - Re-codifica con GD (elimina EXIF/código embebido), corrige orientación
 * - Reduce a un máximo de 1920x1080 manteniendo proporción
 * - Guarda con nombre aleatorio seguro
 */
class ImageUploader
{
    private const ALLOWED = [
        'image/jpeg' => 'jpg',
        'image/png'  => 'png',
        'image/webp' => 'webp',
        'image/gif'  => 'gif',
    ];
    private const MAX_BYTES = 10 * 1024 * 1024;
    private const MAX_W = 1920;
    private const MAX_H = 1080;

    public static function save(?array $file, string $dir): string
    {
        if ($file === null || !isset($file['error']) || is_array($file['error'])) {
            throw new RuntimeException('Archivo no válido.');
        }
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new RuntimeException(self::errorMessage($file['error']));
        }
        if ($file['size'] > self::MAX_BYTES || $file['size'] <= 0) {
            throw new RuntimeException('La imagen supera el máximo de 10 MB.');
        }
        if (!is_uploaded_file($file['tmp_name'])) {
            throw new RuntimeException('Subida no válida.');
        }

        $mime = (new finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']);
        if (!isset(self::ALLOWED[$mime])) {
            throw new RuntimeException('Formato no permitido (usa JPG, PNG, WEBP o GIF).');
        }
        $ext = self::ALLOWED[$mime];

        if (!is_dir($dir) && !mkdir($dir, 0755, true)) {
            throw new RuntimeException('No se puede crear la carpeta de destino.');
        }
        $name = bin2hex(random_bytes(8)) . '.' . $ext;
        $dest = rtrim($dir, "/\\") . DIRECTORY_SEPARATOR . $name;

        // GIF: se guarda tal cual (para no perder la animación), ya validado por finfo
        if ($mime === 'image/gif') {
            if (!move_uploaded_file($file['tmp_name'], $dest)) {
                throw new RuntimeException('No se pudo guardar la imagen.');
            }
            return $name;
        }

        $img = match ($mime) {
            'image/jpeg' => @imagecreatefromjpeg($file['tmp_name']),
            'image/png'  => @imagecreatefrompng($file['tmp_name']),
            'image/webp' => @imagecreatefromwebp($file['tmp_name']),
        };
        if (!$img) {
            throw new RuntimeException('La imagen está dañada o no se puede leer.');
        }

        if ($mime === 'image/jpeg' && function_exists('exif_read_data')) {
            $exif = @exif_read_data($file['tmp_name']);
            $rot = [3 => 180, 6 => -90, 8 => 90][$exif['Orientation'] ?? 1] ?? 0;
            if ($rot) {
                $img = imagerotate($img, $rot, 0);
            }
        }

        $w = imagesx($img);
        $h = imagesy($img);
        $scale = min(self::MAX_W / $w, self::MAX_H / $h, 1);
        if ($scale < 1) {
            $img = imagescale($img, (int) round($w * $scale), (int) round($h * $scale), IMG_BICUBIC);
        }

        $ok = match ($mime) {
            'image/jpeg' => imagejpeg($img, $dest, 85),
            'image/png'  => (imagesavealpha($img, true) && imagepng($img, $dest, 6)),
            'image/webp' => imagewebp($img, $dest, 85),
        };
        imagedestroy($img);
        if (!$ok) {
            throw new RuntimeException('No se pudo guardar la imagen.');
        }
        return $name;
    }

    private static function errorMessage(int $code): string
    {
        return match ($code) {
            UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE => 'La imagen es demasiado grande.',
            UPLOAD_ERR_PARTIAL => 'La subida se interrumpió, inténtalo de nuevo.',
            UPLOAD_ERR_NO_FILE => 'No se ha seleccionado ningún archivo.',
            default => 'Error al subir el archivo (código ' . $code . ').',
        };
    }
}
