<?php
require_once "includes/init.php";

$parceiro = [
    "nome" => "A Imperatriz",
    "bg" => "IMAGENS/IMPERATRIZ.png",
    "links" => [
        ["class" => "social-instagram", "href" => "https://www.instagram.com/a_imperatriz_churrasqueira/", "icon" => "fa-brands fa-instagram", "label" => "Instagram", "external" => true],
        ["class" => "social-maps", "href" => "https://www.google.com/maps/place/A+Imperatriz/", "icon" => "fa-solid fa-location-dot", "label" => "Localização", "external" => true],
        ["class" => "social-phone", "href" => "tel:+351934191343", "icon" => "fa-solid fa-phone", "label" => "Telefone", "external" => false],
    ],
    "icons" => ["fa-utensils", "fa-house-chimney", "fa-people-group"],
];

$pageTranslations = [
    "pt" => [
        "pageTitle" => "A Imperatriz | Lone Wolf",
        "backPartners" => "Voltar aos parceiros",
        "partnerSince" => "Parceria desde 2021",
        "heroText" => "Parceiro do projeto desde 2021.",
        "socialsLabel" => "Redes e contactos",
        "aboutTitle" => "Sobre esta parceria",
        "aboutSubtitle" => "Como trabalhamos em conjunto",
        "aboutText1" => "A Imperatriz faz parte do projeto como parceiro local, representando proximidade, tradição e apoio ao crescimento da Lone Wolf.",
        "aboutText2" => "Esta colaboração reforça a ligação à comunidade do Seixal e valoriza parceiros que acompanham o percurso competitivo do clube.",
        "highlightsTitle" => "Destaques",
        "highlightsSubtitle" => "O que esta colaboração traz ao projeto",
        "highlight1" => "Ligação à comunidade local do Seixal",
        "highlight2" => "Apoio de uma marca próxima e tradicional",
        "highlight3" => "Reforço da rede de parceiros da Lone Wolf",
    ],
    "en" => [
        "pageTitle" => "A Imperatriz | Lone Wolf",
        "backPartners" => "Back to partners",
        "partnerSince" => "Partnership since 2021",
        "heroText" => "Project partner since 2021.",
        "socialsLabel" => "Social media and contacts",
        "aboutTitle" => "About this partnership",
        "aboutSubtitle" => "How we work together",
        "aboutText1" => "A Imperatriz is part of the project as a local partner, representing proximity, tradition and support for Lone Wolf's growth.",
        "aboutText2" => "This collaboration strengthens the connection to the Seixal community and values partners who support the club's competitive journey.",
        "highlightsTitle" => "Highlights",
        "highlightsSubtitle" => "What this collaboration brings to the project",
        "highlight1" => "Connection to the local Seixal community",
        "highlight2" => "Support from a close and traditional brand",
        "highlight3" => "Strengthening Lone Wolf's partner network",
    ],
];

require_once "includes/parceiro-pagina.php";
