<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function sube_imagen($FILES)
{
    $img = new Upload($FILES["image_new"]);
    $image = null;
    if ($img->uploaded !== false) {
        $img->Process("../uploads/");
        if ($img->processed) {
            $image = $img->file_dst_name;
        } else {
            echo 'Error cargando imagen';
            $image = null;
        }
    }
    return $image;
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
    $user->image = (isset($_FILES["image_new"]) && ($_FILES["image_new"]['name'] != '')) ? sube_imagen($_FILES) : $_POST["image"];
    $user->category_id = $_POST["category_id"];
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
    $user->image = (isset($_FILES["image_new"]) && ($_FILES["image_new"]['name'] != '')) ? sube_imagen($_FILES) : $_POST["image"];
    $user->category_id = $_POST["category_id"];
    $user->status = isset($_POST["status"]) ? 1 : 0;
    $user->update();

    Core::redir("./?view=posts");
} else if (isset($_GET["opt"]) && $_GET["opt"] == "del") {
    $category = PostData::getById($_GET["id"]);
    $category->del();
    Core::redir("./index.php?view=posts");
}

