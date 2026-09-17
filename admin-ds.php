<?php
if (defined("LW_ADMIN_DS_LOADED")) {
    return;
}
define("LW_ADMIN_DS_LOADED", true);
?>
<style>
.lw-admin,
.lw-admin .ds-section {
    background: #0a0a0b !important;
    color: #f5f5f4 !important;
}
body.admin-panel-page .hero-admin {
    height: auto !important;
    min-height: var(--lw-hero-h, 420px);
    max-height: none !important;
    overflow: hidden;
    padding: 56px 0 48px;
}
.lw-admin .admin-hero-top {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px 20px;
    margin-bottom: 18px;
}
.lw-admin .admin-hero-top .hero-mini {
    margin-bottom: 0;
}
.lw-admin .admin-voltar-atras {
    margin-top: 0 !important;
    min-height: 38px !important;
    padding: 8px 16px !important;
    background: #e57f1f !important;
    color: #0a0a0b !important;
    border: 0 !important;
    border-radius: 4px !important;
    font-size: 12px !important;
}
.lw-admin .races-filters {
    justify-content: flex-start;
    margin: 0 0 40px;
}
.lw-admin a.races-filter {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
}
.lw-admin a.races-filter em {
    font-style: normal;
    font-family: "JetBrains Mono", ui-monospace, monospace;
    color: #e57f1f;
}
.lw-admin .admin-stats {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 20px;
    margin-bottom: 28px;
}
.lw-admin .races-grid.admin-quick-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 20px;
}
.lw-admin .ds-card,
.lw-admin .admin-kpi,
.lw-admin .admin-conta-card,
.lw-admin .admin-produto-card,
.lw-admin .admin-empty,
.lw-admin .sem-mensagens {
    background: #151517 !important;
    border: 1px solid #26262a !important;
    border-radius: 4px !important;
    box-shadow: none !important;
    color: #f5f5f4 !important;
}
.lw-admin .admin-kpi {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    gap: 18px;
    min-height: 124px;
    padding: 24px 22px;
}
.lw-admin .admin-kpi .stat-label {
    color: #9a9a9d !important;
    font-family: "Outfit", system-ui, sans-serif !important;
    font-size: 12px !important;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
}
.lw-admin .admin-kpi .ds-stat {
    color: #e57f1f !important;
    font-family: "JetBrains Mono", ui-monospace, monospace !important;
    font-size: clamp(32px, 4vw, 44px);
    line-height: 1;
    font-weight: 700;
}
.lw-admin a.ds-card {
    display: flex;
    flex-direction: column;
    gap: 10px;
    padding: 24px 22px;
    text-decoration: none;
}
.lw-admin a.ds-card h3.ds-title {
    margin: 0;
    font-size: 22px;
    color: #f5f5f4 !important;
}
.lw-admin .admin-painel-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 24px;
    flex-wrap: wrap;
    margin-bottom: 28px;
    padding-bottom: 24px;
    border-bottom: 1px solid #26262a;
}
.lw-admin .admin-painel-heading .ds-title,
.lw-admin h2.ds-title {
    margin: 0 0 8px;
    font-size: clamp(28px, 4vw, 40px);
    color: #f5f5f4 !important;
    font-family: "Oswald", Impact, sans-serif;
    text-transform: uppercase;
    letter-spacing: 0.04em;
}
.lw-admin .ds-text,
.lw-admin .painel-subtitulo,
.lw-admin .utilizador-email,
.lw-admin .admin-conversa-preview,
.lw-admin .conta-id,
.lw-admin .admin-conta-sem-acao {
    color: #9a9a9d !important;
}
.lw-admin .utilizador-nome,
.lw-admin .admin-conta-info .utilizador-nome {
    color: #f5f5f4 !important;
    font-family: "Oswald", Impact, sans-serif;
    text-transform: uppercase;
    letter-spacing: 0.04em;
}
.lw-admin .admin-quick-icon {
    width: 46px;
    height: 46px;
    border-radius: 4px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: rgba(229, 127, 31, 0.14);
    color: #e57f1f;
}
.lw-admin .ds-stat {
    color: #e57f1f !important;
    font-family: "JetBrains Mono", ui-monospace, monospace;
}
.lw-admin .resumo-chip {
    background: #151517 !important;
    border: 1px solid #26262a !important;
    color: #9a9a9d !important;
    border-radius: 4px !important;
}
.lw-admin .resumo-chip strong {
    color: #e57f1f !important;
    font-family: "JetBrains Mono", ui-monospace, monospace;
}
.lw-admin .tipo-conta {
    border-radius: 4px !important;
}
.lw-admin .tipo-conta.user {
    background: transparent !important;
    border: 1px solid #26262a !important;
    color: #9a9a9d !important;
}
.lw-admin .tipo-conta.admin {
    background: rgba(229, 127, 31, 0.14) !important;
    border: 1px solid rgba(229, 127, 31, 0.4) !important;
    color: #e57f1f !important;
}
.lw-admin .tipo-conta.blocked {
    background: rgba(180, 40, 40, 0.16) !important;
    border: 1px solid rgba(180, 40, 40, 0.4) !important;
    color: #f5c6c6 !important;
}
.lw-admin .conta-avatar {
    background: #e57f1f !important;
    color: #0a0a0b !important;
}
.lw-admin .admin-menu-btn,
.lw-admin .admin-menu {
    background: #0a0a0b !important;
    border: 1px solid #26262a !important;
    color: #f5f5f4 !important;
    border-radius: 4px !important;
}
.lw-admin .admin-menu-item {
    color: #f5f5f4 !important;
    background: transparent !important;
}
.lw-admin .admin-menu-item:hover {
    background: rgba(229, 127, 31, 0.12) !important;
    color: #e57f1f !important;
}
.lw-admin .admin-menu-item.danger {
    color: #f5c6c6 !important;
}
.lw-admin input:not([type="checkbox"]):not([type="hidden"]):not([type="radio"]),
.lw-admin select,
.lw-admin textarea {
    background: #0a0a0b !important;
    color: #f5f5f4 !important;
    border: 1px solid #26262a !important;
    border-radius: 4px !important;
}
.lw-admin .ds-btn-primary,
.lw-admin .btn-action.guardar {
    background: #e57f1f !important;
    color: #0a0a0b !important;
    border: 0 !important;
    border-radius: 4px !important;
}
.lw-admin .admin-empty {
    padding: 48px 24px;
    text-align: center;
}
.lw-admin .admin-empty .ds-title {
    margin: 0 0 10px;
    font-size: 28px;
    color: #f5f5f4 !important;
}
.lw-admin .admin-produto-card {
    display: grid !important;
    grid-template-columns: minmax(220px, 1fr) minmax(280px, 1.1fr);
    align-items: center;
    gap: 24px;
    padding: 22px 24px;
}
.lw-admin .admin-produto-form {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-end;
    gap: 14px;
}
.lw-admin .admin-produto-form label {
    display: flex;
    flex-direction: column;
    gap: 6px;
    min-width: 120px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: #9a9a9d;
}
.lw-admin .admin-checkbox-label {
    flex-direction: row !important;
    align-items: center;
    color: #f5f5f4 !important;
}
.lw-admin .alerta.sucesso {
    background: rgba(31, 122, 63, 0.16);
    border: 1px solid rgba(31, 122, 63, 0.4);
    color: #d4f0dc;
}
.lw-admin .alerta.erro {
    background: rgba(180, 40, 40, 0.16);
    border: 1px solid rgba(180, 40, 40, 0.4);
    color: #f5c6c6;
}
@media (max-width: 960px) {
    .lw-admin .admin-stats,
    .lw-admin .races-grid.admin-quick-grid,
    .lw-admin .admin-produto-card {
        grid-template-columns: 1fr;
    }
}
</style>
