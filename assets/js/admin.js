(function () {
    function escapeHtml(text) {
        const div = document.createElement("div");
        div.textContent = text;
        return div.innerHTML;
    }

    function ensureDialogRoot() {
        let root = document.getElementById("chat-dialog-root");
        if (root) return root;

        root = document.createElement("div");
        root.id = "chat-dialog-root";
        document.body.appendChild(root);
        return root;
    }

    function showAdminConfirm(options = {}) {
        const {
            title = "Confirmar acao",
            message = "Tens a certeza?",
            confirmText = "Confirmar",
            cancelText = "Cancelar",
            variant = "danger",
            icon = "fa-circle-question",
        } = options;

        return new Promise((resolve) => {
            const root = ensureDialogRoot();
            const overlay = document.createElement("div");
            overlay.className = "chat-dialog-overlay";
            overlay.innerHTML = `
                <div class="chat-dialog" role="dialog" aria-modal="true">
                    <div class="chat-dialog-icon ${escapeHtml(variant)}">
                        <i class="fa-solid ${escapeHtml(icon)}" aria-hidden="true"></i>
                    </div>
                    <h3 class="chat-dialog-title">${escapeHtml(title)}</h3>
                    <p class="chat-dialog-message">${escapeHtml(message)}</p>
                    <div class="chat-dialog-actions">
                        <button type="button" class="chat-dialog-btn cancel">${escapeHtml(cancelText)}</button>
                        <button type="button" class="chat-dialog-btn confirm ${escapeHtml(variant)}">${escapeHtml(confirmText)}</button>
                    </div>
                </div>
            `;

            const close = (result) => {
                overlay.classList.remove("visible");
                window.setTimeout(() => overlay.remove(), 220);
                document.removeEventListener("keydown", onKeydown);
                resolve(result);
            };

            const onKeydown = (event) => {
                if (event.key === "Escape") close(false);
            };

            root.appendChild(overlay);
            requestAnimationFrame(() => overlay.classList.add("visible"));
            document.addEventListener("keydown", onKeydown);

            overlay.addEventListener("click", (event) => {
                if (event.target === overlay) close(false);
            });

            overlay.querySelector(".cancel").addEventListener("click", () => close(false));
            overlay.querySelector(".confirm").addEventListener("click", () => close(true));
            overlay.querySelector(".confirm").focus();
        });
    }

    function closeAllMenus(except) {
        document.querySelectorAll(".admin-menu").forEach((menu) => {
            if (menu !== except) {
                menu.hidden = true;
            }
        });

        document.querySelectorAll(".admin-menu-btn").forEach((button) => {
            if (!except || button.nextElementSibling !== except) {
                button.setAttribute("aria-expanded", "false");
            }
        });
    }

    function initAdminMenus() {
        document.addEventListener("click", (event) => {
            const button = event.target.closest(".admin-menu-btn");
            if (button) {
                event.preventDefault();
                const menu = button.nextElementSibling;
                if (!menu) return;

                const willOpen = menu.hidden;
                closeAllMenus(willOpen ? menu : null);
                menu.hidden = !willOpen;
                button.setAttribute("aria-expanded", willOpen ? "true" : "false");
                return;
            }

            if (!event.target.closest(".admin-menu-wrap")) {
                closeAllMenus();
            }
        });
    }

    function initAdminConfirms() {
        document.addEventListener("click", async (event) => {
            const link = event.target.closest("[data-admin-confirm]");
            if (!link) return;

            event.preventDefault();
            closeAllMenus();

            const confirmed = await showAdminConfirm({
                title: link.dataset.confirmTitle || "Confirmar acao",
                message: link.dataset.confirmMessage || "Tens a certeza?",
                confirmText: link.dataset.confirmText || "Confirmar",
                cancelText: "Cancelar",
                variant: link.dataset.confirmVariant || "default",
                icon: link.dataset.confirmIcon || "fa-circle-question",
            });

            if (confirmed) {
                window.location.href = link.getAttribute("href");
            }
        });
    }

    function initDeleteAccount() {
        document.addEventListener("click", async (event) => {
            const button = event.target.closest("[data-apagar-conta]");
            if (!button) return;

            event.preventDefault();
            closeAllMenus();

            const userId = button.dataset.apagarConta;
            const nome = button.dataset.nome || "este utilizador";

            const confirmed = await showAdminConfirm({
                title: "Apagar conta",
                message: `A conta de ${nome} sera eliminada permanentemente, incluindo conversas e dados associados.`,
                confirmText: "Apagar conta",
                cancelText: "Cancelar",
                variant: "danger",
                icon: "fa-user-xmark",
            });

            if (!confirmed) return;

            const form = document.createElement("form");
            form.method = "POST";
            form.action = "apagar_conta.php";

            const input = document.createElement("input");
            input.type = "hidden";
            input.name = "user_id";
            input.value = userId;
            form.appendChild(input);

            document.body.appendChild(form);
            form.submit();
        });
    }

    document.addEventListener("DOMContentLoaded", () => {
        initAdminConfirms();

        if (document.body.classList.contains("admin-panel-page")) {
            initAdminMenus();
            initDeleteAccount();
        }
    });
})();
