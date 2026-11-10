<?php

function sube_imagen($FILES, $actual = '')
{
    try {
        return ImageUploader::save($FILES["image_new"], dirname(__DIR__, 4) . DIRECTORY_SEPARATOR . 'uploads');
    } catch (RuntimeException $e) {
        echo "<script>alert(" . json_encode('Error con la imagen: ' . $e->getMessage()) . ");</script>";
        return $actual;
    }
}


// Limpia el HTML del editor enriquecido: solo etiquetas de formato, sin scripts ni eventos
function limpia_html($html)
{
    $permitidas = '<p><br><b><strong><i><em><u><s><strike><span><div><h1><h2><h3><h4><h5><h6><ul><ol><li><a><blockquote><table><thead><tbody><tr><th><td><hr><sub><sup>';
    $html = preg_replace('#<(script|style|iframe|object|embed)\b.*?</\1>#is', '', $html);
    $html = strip_tags($html, $permitidas);
    $html = preg_replace('#\son\w+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)#i', '', $html);
    $html = preg_replace('#(href|src)\s*=\s*("|\')\s*javascript:[^"\']*\2#i', '$1="#"', $html);
    return trim($html);
}

foreach (['brief', 'brief_es', 'brief_de', 'content', 'content_es', 'content_de'] as $campo_rico) {
    if (isset($_POST[$campo_rico])) {
        $_POST[$campo_rico] = limpia_html($_POST[$campo_rico]);
    }
}

if (isset($_GET["opt"]) && $_GET["opt"] == "add") {
    $user = new PostData();
    $user->title = $_POST["title"];
    $user->title_es = $_POST["title_es"];
    $user->title_de = $_POST["title_de"];
    $user->brief = $_POST["brief"];
    $user->brief_es = $_POST["brief_es"];
    $user->brief_de = $_POST["brief_de"];
    $user->content = $_POST["content"];
    $user->content_es = $_POST["content_es"];
    $user->content_de = $_POST["content_de"];
    $user->destination = $_POST["destination"];
    $user->image = (isset($_FILES["image_new"]) && ($_FILES["image_new"]['name'] != '')) ? sube_imagen($_FILES, $_POST["image"]) : $_POST["image"];
    $user->category_id = $_POST["category_id"];
    $user->publish_at = $_POST["publish_at"] ?? '';
    $user->expires_at = $_POST["expires_at"] ?? '';
    $user->add();

    Core::redir("./?view=posts");
} else if (isset($_GET["opt"]) && $_GET["opt"] == "update") {
    $user = PostData::getById($_POST["id"]);
    $user->title = $_POST["title"];
    $user->title_es = $_POST["title_es"];
    $user->title_de = $_POST["title_de"];
    $user->brief = $_POST["brief"];
    $user->brief_es = $_POST["brief_es"];
    $user->brief_de = $_POST["brief_de"];
    $user->content = $_POST["content"];
    $user->content_es = $_POST["content_es"];
    $user->content_de = $_POST["content_de"];
    $user->destination = $_POST["destination"];
    $user->image = (isset($_FILES["image_new"]) && ($_FILES["image_new"]['name'] != '')) ? sube_imagen($_FILES, $_POST["image"]) : $_POST["image"];
    $user->category_id = $_POST["category_id"];
    $user->publish_at = $_POST["publish_at"] ?? '';
    $user->expires_at = $_POST["expires_at"] ?? '';
    $user->status = isset($_POST["status"]) ? 1 : 0;
    $user->update();

    Core::redir("./?view=posts");
} else if (isset($_GET["opt"]) && $_GET["opt"] == "del") {
    $category = PostData::getById($_GET["id"]);
    $category->del();
    Core::redir("./index.php?view=posts");
}

