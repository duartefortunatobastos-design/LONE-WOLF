<?php

$baseDir = dirname(__DIR__);

$withImageVariants = static function (array $item) use ($baseDir): array {
    $path = $item["imagem"] ?? "";
    if ($path === "") {
        return $item;
    }

    $webp = preg_replace('/\.(jpe?g|png)$/i', ".webp", $path);
    if ($webp !== $path && is_file($baseDir . DIRECTORY_SEPARATOR . str_replace("/", DIRECTORY_SEPARATOR, $webp))) {
        $item["imagem_webp"] = $webp;
    }

    return $item;
};

return array_map($withImageVariants, [
    [
        "id" => "competicao",
        "categoria" => "competicao",
        "tag" => "Maratona Madrid",
        "tag_en" => "Madrid Marathon",
        "titulo" => "Espírito Lone Wolf",
        "titulo_en" => "Lone Wolf Spirit",
        "descricao" => "Foco, garra e consistência em cada desafio.",
        "descricao_en" => "Focus, grit and consistency in every challenge.",
        "imagem" => "IMAGENS/PAI_4.jpeg",
        "destaque" => true,
    ],
    [
        "id" => "competicao-porto",
        "categoria" => "competicao",
        "tag" => "Maratona Porto",
        "tag_en" => "Porto Marathon",
        "titulo" => "Competição",
        "titulo_en" => "Competition",
        "descricao" => "Onde a mente e o corpo são postos à prova.",
        "descricao_en" => "Where mind and body are tested.",
        "imagem" => "IMAGENS/FOTO_PORTO.jpg",
        "destaque" => true,
    ],
    [
        "id" => "competicao-ispcsi",
        "categoria" => "competicao",
        "tag" => "Corrida ISPCSI",
        "tag_en" => "ISPCSI Race",
        "titulo" => "Ritmo de Prova",
        "titulo_en" => "Race Pace",
        "descricao" => "Cada quilómetro conta na construção do resultado.",
        "descricao_en" => "Every kilometre counts towards the result.",
        "imagem" => "IMAGENS/PAI_3.jpeg",
        "destaque" => false,
    ],
    [
        "id" => "treino-fatima",
        "categoria" => "treino",
        "tag" => "Corrida até Fátima",
        "tag_en" => "Run to Fátima",
        "titulo" => "Resistência",
        "titulo_en" => "Endurance",
        "descricao" => "Superar distâncias com foco e determinação.",
        "descricao_en" => "Overcoming distances with focus and determination.",
        "imagem" => "IMAGENS/PAI_2.jpeg",
        "destaque" => false,
    ],
    [
        "id" => "equipamento",
        "categoria" => "equipamento",
        "tag" => "Equipamento",
        "tag_en" => "Gear",
        "titulo" => "Lone Wolf",
        "titulo_en" => "Lone Wolf",
        "descricao" => "Identidade, disciplina e mentalidade competitiva.",
        "descricao_en" => "Identity, discipline and competitive mindset.",
        "imagem" => "IMAGENS/foto_atleta.png",
        "cta" => "loja.php",
        "cta_label" => "Ver loja",
        "cta_label_en" => "Shop",
        "destaque" => false,
    ],
    [
        "id" => "treino-foco",
        "categoria" => "treino",
        "tag" => "Foco",
        "tag_en" => "Focus",
        "titulo" => "Mente no Alvo",
        "titulo_en" => "Mind on Target",
        "descricao" => "Foco total. Nada tira do caminho.",
        "descricao_en" => "Total focus. Nothing gets in the way.",
        "imagem" => "IMAGENS/PAI_1.jpeg",
        "destaque" => false,
    ],
]);
