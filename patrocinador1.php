<?php
require_once "includes/init.php";

$parceiro = [
    "nome" => "Predial Piedense",
    "bg" => "IMAGENS/PREDIAL_PIEDENSE.jpeg",
    "links" => [
        ["class" => "social-instagram", "href" => "https://www.instagram.com/predial.piedense/", "icon" => "fa-brands fa-instagram", "label" => "Instagram", "external" => true],
        ["class" => "social-website", "href" => "https://www.predialpiedense.net", "icon" => "fa-solid fa-globe", "label" => "Website", "external" => true],
        ["class" => "social-maps", "href" => "https://www.google.com/maps/place/Predial+Piedense/@38.6716103,-9.1627163,17z", "icon" => "fa-solid fa-location-dot", "label" => "Localização", "external" => true],
        ["class" => "social-phone", "href" => "tel:212752097", "icon" => "fa-solid fa-phone", "label" => "Telefone", "external" => false],
    ],
    "icons" => ["fa-building", "fa-handshake", "fa-bullhorn"],
];

$pageTranslations = [
    "pt" => [
        "pageTitle" => "Predial Piedense | Lone Wolf",
        "backPartners" => "Voltar aos parceiros",
        "partnerSince" => "Parceria desde 2021",
        "heroText" => "Parceiro oficial do projeto desde 2021.",
        "socialsLabel" => "Redes e site",
        "aboutTitle" => "Sobre esta parceria",
        "aboutSubtitle" => "Como trabalhamos em conjunto",
        "aboutText1" => "A Predial Piedense acompanha o crescimento do projeto com uma relação assente em confiança, proximidade e apoio contínuo à identidade da Lone Wolf.",
        "aboutText2" => "Em conjunto valorizamos a presença local, a ligação à comunidade e a força de parcerias sólidas que ajudam a impulsionar o clube.",
        "highlightsTitle" => "Destaques",
        "highlightsSubtitle" => "O que esta colaboração traz ao projeto",
        "highlight1" => "Reforço da presença local da marca",
        "highlight2" => "Ligação a uma empresa de referência na região",
        "highlight3" => "Apoio institucional e visibilidade conjunta",
    ],
    "en" => [
        "pageTitle" => "Predial Piedense | Lone Wolf",
        "backPartners" => "Back to partners",
        "partnerSince" => "Partnership since 2021",
        "heroText" => "Official project partner since 2021.",
        "socialsLabel" => "Social media and website",
        "aboutTitle" => "About this partnership",
        "aboutSubtitle" => "How we work together",
        "aboutText1" => "Predial Piedense supports the growth of the project through a relationship based on trust, proximity and continuous support for Lone Wolf's identity.",
        "aboutText2" => "Together, we value local presence, community connection and the strength of solid partnerships that help drive the club forward.",
        "highlightsTitle" => "Highlights",
        "highlightsSubtitle" => "What this collaboration brings to the project",
        "highlight1" => "Strengthening the brand's local presence",
        "highlight2" => "Connection to a reference company in the region",
        "highlight3" => "Institutional support and shared visibility",
    ],
];

require_once "includes/parceiro-pagina.php";
