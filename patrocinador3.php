<?php
require_once "includes/init.php";

$parceiro = [
    "nome" => "LH Ginásio",
    "bg" => "IMAGENS/LH_GINASIO.jpeg",
    "links" => [
        ["class" => "social-instagram", "href" => "https://www.instagram.com/lhginasio/", "icon" => "fa-brands fa-instagram", "label" => "Instagram", "external" => true],
        ["class" => "social-maps", "href" => "https://www.google.com/maps/place/LH+Gin%C3%A1sio/", "icon" => "fa-solid fa-location-dot", "label" => "Localização", "external" => true],
        ["class" => "social-phone", "href" => "tel:+351968742013", "icon" => "fa-solid fa-phone", "label" => "Telefone", "external" => false],
    ],
    "icons" => ["fa-dumbbell", "fa-heart-pulse", "fa-chart-line"],
];

$pageTranslations = [
    "pt" => [
        "pageTitle" => "LH Ginásio | Lone Wolf",
        "backPartners" => "Voltar aos parceiros",
        "partnerSince" => "Parceria desde 2021",
        "heroText" => "Parceiro oficial do projeto desde 2021.",
        "socialsLabel" => "Redes e site",
        "aboutTitle" => "Sobre esta parceria",
        "aboutSubtitle" => "Como trabalhamos em conjunto",
        "aboutText1" => "O LH Ginásio integra-se no projeto como parceiro ligado à preparação física, disciplina, recuperação e desenvolvimento do atleta.",
        "aboutText2" => "Em conjunto promovemos uma cultura de treino, compromisso e superação, alinhada com a identidade competitiva da Lone Wolf.",
        "highlightsTitle" => "Destaques",
        "highlightsSubtitle" => "O que esta colaboração traz ao projeto",
        "highlight1" => "Apoio à preparação física dos atletas",
        "highlight2" => "Ligação ao treino, rendimento e recuperação",
        "highlight3" => "Promoção de disciplina e evolução constante",
    ],
    "en" => [
        "pageTitle" => "LH Gym | Lone Wolf",
        "backPartners" => "Back to partners",
        "partnerSince" => "Partnership since 2021",
        "heroText" => "Official project partner since 2021.",
        "socialsLabel" => "Social media and website",
        "aboutTitle" => "About this partnership",
        "aboutSubtitle" => "How we work together",
        "aboutText1" => "LH Gym is part of the project as a partner connected to physical preparation, discipline, recovery and athlete development.",
        "aboutText2" => "Together, we promote a culture of training, commitment and self-improvement, aligned with Lone Wolf's competitive identity.",
        "highlightsTitle" => "Highlights",
        "highlightsSubtitle" => "What this collaboration brings to the project",
        "highlight1" => "Support for the athletes' physical preparation",
        "highlight2" => "Connection to training, performance and recovery",
        "highlight3" => "Promotion of discipline and constant progress",
    ],
];

require_once "includes/parceiro-pagina.php";
