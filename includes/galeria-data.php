<?php

$baseDir = dirname(__DIR__);
$provasDir = $baseDir . DIRECTORY_SEPARATOR . "IMAGENS" . DIRECTORY_SEPARATOR . "provas";

$curated = [
    "FOTO_PORTO.jpg" => [
        "id" => "competicao-porto",
        "categoria" => "competicao",
        "tag" => "Maratona Porto",
        "tag_en" => "Porto Marathon",
        "titulo" => "Competição",
        "titulo_en" => "Competition",
        "descricao" => "Onde a mente e o corpo são postos à prova.",
        "descricao_en" => "Where mind and body are tested.",
        "destaque" => true,
    ],
    "PAI_4.jpeg" => [
        "id" => "competicao-madrid",
        "categoria" => "competicao",
        "tag" => "Maratona Madrid",
        "tag_en" => "Madrid Marathon",
        "titulo" => "Espírito Lone Wolf",
        "titulo_en" => "Lone Wolf Spirit",
        "descricao" => "Foco, garra e consistência em cada desafio.",
        "descricao_en" => "Focus, grit and consistency in every challenge.",
        "destaque" => true,
    ],
    "PAI_3.jpeg" => [
        "id" => "competicao-ispcsi",
        "categoria" => "competicao",
        "tag" => "Corrida ISPCSI",
        "tag_en" => "ISPCSI Race",
        "titulo" => "Ritmo de Prova",
        "titulo_en" => "Race Pace",
        "descricao" => "Cada quilómetro conta na construção do resultado.",
        "descricao_en" => "Every kilometre counts towards the result.",
    ],
    "PAI_2.jpeg" => [
        "id" => "treino-fatima",
        "categoria" => "treino",
        "tag" => "Corrida até Fátima",
        "tag_en" => "Run to Fátima",
        "titulo" => "Resistência",
        "titulo_en" => "Endurance",
        "descricao" => "Superar distâncias com foco e determinação.",
        "descricao_en" => "Overcoming distances with focus and determination.",
    ],
    "PAI_1.jpeg" => [
        "id" => "treino-foco",
        "categoria" => "treino",
        "tag" => "Foco",
        "tag_en" => "Focus",
        "titulo" => "Mente no Alvo",
        "titulo_en" => "Mind on Target",
        "descricao" => "Foco total. Nada tira do caminho.",
        "descricao_en" => "Total focus. Nothing gets in the way.",
    ],
    "foto_atleta.png" => [
        "id" => "equipamento",
        "categoria" => "equipamento",
        "tag" => "Equipamento",
        "tag_en" => "Gear",
        "titulo" => "Lone Wolf",
        "titulo_en" => "Lone Wolf",
        "descricao" => "Identidade, disciplina e mentalidade competitiva.",
        "descricao_en" => "Identity, discipline and competitive mindset.",
        "cta" => "loja.php",
        "cta_label" => "Ver loja",
        "cta_label_en" => "Shop",
    ],
    "EU_PAI.png" => [
        "id" => "treino-eu-pai",
        "categoria" => "treino",
        "tag" => "Atleta",
        "tag_en" => "Athlete",
        "titulo" => "Lone Wolf",
        "titulo_en" => "Lone Wolf",
        "descricao" => "A caminhada, o método e a identidade.",
        "descricao_en" => "The journey, the method and the identity.",
    ],
];

$series = [
    "15.39.37" => ["tag" => "Ritmo", "tag_en" => "Race pace", "titulo" => "Em prova", "titulo_en" => "In the race", "descricao" => "Cadência, foco e presença na estrada.", "descricao_en" => "Cadence, focus and presence on the road."],
    "15.40.33" => ["tag" => "Percurso", "tag_en" => "Course", "titulo" => "No caminho", "titulo_en" => "On the course", "descricao" => "Quilómetros de trabalho e consistência.", "descricao_en" => "Kilometres of work and consistency."],
    "15.42.10" => ["tag" => "Prova", "tag_en" => "Race", "titulo" => "Competição", "titulo_en" => "Competition", "descricao" => "O esforço no momento certo.", "descricao_en" => "Effort at the right moment."],
    "15.43.40" => ["tag" => "Prova", "tag_en" => "Race", "titulo" => "Firmeza", "titulo_en" => "Composure", "descricao" => "Postura de prova até ao fim.", "descricao_en" => "Race composure through to the end."],
    "15.43.41" => ["tag" => "Prova", "tag_en" => "Race", "titulo" => "Firmeza", "titulo_en" => "Composure", "descricao" => "Postura de prova até ao fim.", "descricao_en" => "Race composure through to the end."],
    "15.45.11" => ["tag" => "Prova", "tag_en" => "Race", "titulo" => "Detalhe", "titulo_en" => "Detail", "descricao" => "Os pormenores que constroem o resultado.", "descricao_en" => "The details that build the result."],
    "15.46.49" => ["tag" => "Competição", "tag_en" => "Competition", "titulo" => "Ritmo de elite", "titulo_en" => "Elite pace", "descricao" => "Fotografia de prova. Sem atalhos.", "descricao_en" => "Race photography. No shortcuts."],
    "15.46.50" => ["tag" => "Competição", "tag_en" => "Competition", "titulo" => "Ritmo de elite", "titulo_en" => "Elite pace", "descricao" => "Fotografia de prova. Sem atalhos.", "descricao_en" => "Race photography. No shortcuts."],
    "15.48.37" => ["tag" => "Meta", "tag_en" => "Finish", "titulo" => "Chegada", "titulo_en" => "Finish", "descricao" => "O fecho da prova, com tudo o que ficou para trás.", "descricao_en" => "The close of the race, with everything left behind."],
    "15.48.38" => ["tag" => "Meta", "tag_en" => "Finish", "titulo" => "Chegada", "titulo_en" => "Finish", "descricao" => "O fecho da prova, com tudo o que ficou para trás.", "descricao_en" => "The close of the race, with everything left behind."],
    "15.48.39" => ["tag" => "Meta", "tag_en" => "Finish", "titulo" => "Chegada", "titulo_en" => "Finish", "descricao" => "O fecho da prova, com tudo o que ficou para trás.", "descricao_en" => "The close of the race, with everything left behind."],
    "15.49.18" => ["tag" => "Meta", "tag_en" => "Finish", "titulo" => "Depois da linha", "titulo_en" => "After the line", "descricao" => "O momento a seguir ao esforço.", "descricao_en" => "The moment after the effort."],
    "15.49.19" => ["tag" => "Meta", "tag_en" => "Finish", "titulo" => "Depois da linha", "titulo_en" => "After the line", "descricao" => "O momento a seguir ao esforço.", "descricao_en" => "The moment after the effort."],
];

$galeriaSlug = static function (string $name): string {
    $slug = strtolower(preg_replace('/[^a-zA-Z0-9]+/', "-", pathinfo($name, PATHINFO_FILENAME)) ?? "");
    $slug = trim($slug, "-");
    return $slug !== "" ? $slug : "foto";
};

$galeriaOrientacao = static function (string $absPath): string {
    $size = @getimagesize($absPath);
    if (!$size) {
        return "portrait";
    }
    [$width, $height] = $size;
    if ($width > $height * 1.08) {
        return "landscape";
    }
    if ($height > $width * 1.08) {
        return "portrait";
    }
    return "square";
};

$found = [];
if (is_dir($provasDir)) {
    foreach (scandir($provasDir) ?: [] as $file) {
        if ($file === "." || $file === "..") {
            continue;
        }
        if (!preg_match('/\.(jpe?g|png|webp)$/i', $file)) {
            continue;
        }
        $found[] = $file;
    }
}

$priority = array_keys($curated);
usort($found, static function (string $a, string $b) use ($priority): int {
    $ia = array_search($a, $priority, true);
    $ib = array_search($b, $priority, true);
    $ia = $ia === false ? PHP_INT_MAX : $ia;
    $ib = $ib === false ? PHP_INT_MAX : $ib;
    if ($ia !== $ib) {
        return $ia <=> $ib;
    }
    return strnatcasecmp($a, $b);
});

$items = [];
$usedIds = [];

foreach ($found as $file) {
    $abs = $provasDir . DIRECTORY_SEPARATOR . $file;
    $meta = $curated[$file] ?? null;

    if ($meta === null) {
        $batch = null;
        foreach ($series as $key => $data) {
            if (str_contains($file, $key)) {
                $batch = $data;
                break;
            }
        }
        $meta = ($batch ?? [
            "tag" => "Prova",
            "tag_en" => "Race",
            "titulo" => "Em prova",
            "titulo_en" => "In the race",
            "descricao" => "Momento de competição Lone Wolf.",
            "descricao_en" => "A Lone Wolf race moment.",
        ]) + [
            "id" => "prova-" . $galeriaSlug($file),
            "categoria" => "competicao",
            "destaque" => false,
        ];
    }

    $id = $meta["id"];
    $n = 2;
    while (isset($usedIds[$id])) {
        $id = $meta["id"] . "-" . $n;
        $n++;
    }
    $usedIds[$id] = true;
    $meta["id"] = $id;
    $meta["imagem"] = "IMAGENS/provas/" . $file;
    $meta["orientacao"] = $galeriaOrientacao($abs);
    $meta["destaque"] = !empty($meta["destaque"]);
    $items[] = $meta;
}

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

return array_map($withImageVariants, $items);
