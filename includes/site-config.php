<?php

require_once __DIR__ . "/env.php";

carregar_env(__DIR__ . "/../.env");

$emailUser = env_var("EMAIL_USER", "lonewolf.runner.pt@gmail.com");
$emailPass = strtolower(str_replace([" ", "-", "\r", "\n"], "", env_var("EMAIL_PASS")));

$config = [
    "site_url" => env_var("SITE_URL", "http://localhost:8000"),
    "site_name" => "Lone Wolf — Rui Bastos",

    "contact_email" => $emailUser,
    "orders_email" => $emailUser,

    "smtp_host" => "smtp.gmail.com",
    "smtp_port" => 587,
    "smtp_user" => $emailUser,
    "smtp_pass" => $emailPass,
    "smtp_from_email" => $emailUser,
    "smtp_from_name" => "LoneWolf Runner",

    "instagram_url" => "https://www.instagram.com/ruibastos.lonewolf/",
    "facebook_url" => "https://www.facebook.com/rui.bastos.39",
    "strava_url" => "https://www.strava.com/",
    "whatsapp" => "+351969758699",
    "maps_embed" => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3113.5!2d-9.15!3d38.65!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzfCsDM5JzAwLjAiTiA5wrAwOScwMC4wIlc!5e0!3m2!1spt-PT!2spt!4v1700000000000!5m2!1spt-PT!2spt",
    "analytics_id" => "",
    "bank_iban" => "PT50 0000 0000 0000 0000 0000 0",
    "bank_mbway" => "969758699",
];

$local = __DIR__ . "/mail-config.local.php";
if (file_exists($local)) {
    $config = array_merge($config, require $local);
}

if ($config["smtp_from_email"] === "" && $config["smtp_user"] !== "") {
    $config["smtp_from_email"] = $config["smtp_user"];
}

return $config;
