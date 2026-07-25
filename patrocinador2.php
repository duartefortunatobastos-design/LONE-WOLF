<?php
require_once "includes/init.php";

$parceiro = [
    "nome" => "Filipe Paiva Transportes",
    "bg" => "IMAGENS/FILIPE_PAIVA.png",
    "links" => [
        ["class" => "social-maps", "href" => "https://www.google.com/maps/place/Pinhal+de+Frades,+2840-167+Arrentela/", "icon" => "fa-solid fa-location-dot", "label" => "Localização", "external" => true],
        ["class" => "social-phone", "href" => "tel:+351968281116", "icon" => "fa-solid fa-phone", "label" => "Telefone", "external" => false],
    ],
    "icons" => ["fa-handshake", "fa-map-location-dot", "fa-users"],
];

$pageTranslations = [
    "pt" => [
        "pageTitle" => "Filipe Paiva Transportes | Lone Wolf",
        "backPartners" => "Voltar aos parceiros",
        "partnerSince" => "Parceria desde 2021",
        "heroText" => "Parceiro do projeto desde 2021.",
        "socialsLabel" => "Redes e contactos",
        "aboutTitle" => "Sobre esta parceria",
        "aboutSubtitle" => "Como trabalhamos em conjunto",
        "aboutText1" => "A Filipe Paiva Transportes faz parte do projeto como parceiro de confiança, representando compromisso, proximidade e apoio ao crescimento sustentado da Lone Wolf.",
        "aboutText2" => "Esta colaboração valoriza empresas locais que acreditam no esforço, na consistência e na evolução contínua do clube.",
        "highlightsTitle" => "Destaques",
        "highlightsSubtitle" => "O que esta colaboração traz ao projeto",
        "highlight1" => "Relação de confiança e proximidade",
        "highlight2" => "Valorização de parceiros da região",
        "highlight3" => "Reforço da base de apoio ao projeto",
    ],
    "en" => [
        "pageTitle" => "Filipe Paiva Transportes | Lone Wolf",
        "backPartners" => "Back to partners",
        "partnerSince" => "Partnership since 2021",
        "heroText" => "Project partner since 2021.",
        "socialsLabel" => "Social media and contacts",
        "aboutTitle" => "About this partnership",
        "aboutSubtitle" => "How we work together",
        "aboutText1" => "Filipe Paiva Transportes is part of the project as a trusted partner, representing commitment, proximity and support for Lone Wolf's sustained growth.",
        "aboutText2" => "This collaboration values local companies that believe in effort, consistency and the club's continuous progress.",
        "highlightsTitle" => "Highlights",
        "highlightsSubtitle" => "What this collaboration brings to the project",
        "highlight1" => "A relationship based on trust and proximity",
        "highlight2" => "Valuing partners from the region",
        "highlight3" => "Strengthening the project's support base",
    ],
];

require_once "includes/parceiro-pagina.php";
