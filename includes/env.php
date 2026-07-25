<?php

function carregar_env(string $caminho): void
{
    if (!file_exists($caminho)) {
        return;
    }

    $linhas = file($caminho, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($linhas === false) {
        return;
    }

    foreach ($linhas as $linha) {
        $linha = trim($linha);

        if ($linha === "" || str_starts_with($linha, "#")) {
            continue;
        }

        if (!str_contains($linha, "=")) {
            continue;
        }

        [$chave, $valor] = explode("=", $linha, 2);
        $chave = trim($chave);
        $valor = trim($valor, " \t\n\r\0\x0B\"'");
        $valor = preg_replace('/^\xEF\xBB\xBF/', '', $valor);
        $valor = str_replace(["\r", "\n"], "", $valor);

        if ($chave !== "") {
            $_ENV[$chave] = $valor;
            putenv("{$chave}={$valor}");
        }
    }
}

function env_var(string $chave, string $default = ""): string
{
    $valor = $_ENV[$chave] ?? getenv($chave);

    if ($valor === false || $valor === null || $valor === "") {
        return $default;
    }

    return (string) $valor;
}
