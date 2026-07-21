(function () {

    function scrollChatToBottom(container) {

        if (!container) return;

        container.scrollTop = container.scrollHeight;

    }



    function escapeHtml(text) {

        const div = document.createElement("div");

        div.textContent = text;

        return div.innerHTML;

    }



    function ensureChatDialogRoot() {
        let root = document.getElementById("chat-dialog-root");
        if (root) return root;

        root = document.createElement("div");
        root.id = "chat-dialog-root";
        document.body.appendChild(root);
        return root;
    }

    function showChatConfirm(options = {}) {
        const {
            title = "Confirmar acao",
            message = "Tens a certeza?",
            confirmText = "Confirmar",
            cancelText = "Cancelar",
            variant = "danger",
            icon = "fa-trash-can",
        } = options;

        return new Promise((resolve) => {
            const root = ensureChatDialogRoot();
            const overlay = document.createElement("div");
            overlay.className = "chat-dialog-overlay";
            overlay.innerHTML = `
                <div class="chat-dialog" role="dialog" aria-modal="true" aria-labelledby="chat-dialog-title">
                    <div class="chat-dialog-icon ${escapeHtml(variant)}">
                        <i class="fa-solid ${escapeHtml(icon)}" aria-hidden="true"></i>
                    </div>
                    <h3 class="chat-dialog-title" id="chat-dialog-title">${escapeHtml(title)}</h3>
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

    function showChatNotice(message, options = {}) {
        const {
            title = "Aviso",
            confirmText = "Entendi",
            variant = "default",
            icon = "fa-circle-info",
        } = options;

        return new Promise((resolve) => {
            const root = ensureChatDialogRoot();
            const overlay = document.createElement("div");
            overlay.className = "chat-dialog-overlay";
            overlay.innerHTML = `
                <div class="chat-dialog" role="alertdialog" aria-modal="true" aria-labelledby="chat-dialog-title">
                    <div class="chat-dialog-icon ${escapeHtml(variant)}">
                        <i class="fa-solid ${escapeHtml(icon)}" aria-hidden="true"></i>
                    </div>
                    <h3 class="chat-dialog-title" id="chat-dialog-title">${escapeHtml(title)}</h3>
                    <p class="chat-dialog-message">${escapeHtml(message)}</p>
                    <div class="chat-dialog-actions single">
                        <button type="button" class="chat-dialog-btn confirm ${escapeHtml(variant)}">${escapeHtml(confirmText)}</button>
                    </div>
                </div>
            `;

            const close = () => {
                overlay.classList.remove("visible");
                window.setTimeout(() => overlay.remove(), 220);
                document.removeEventListener("keydown", onKeydown);
                resolve(true);
            };

            const onKeydown = (event) => {
                if (event.key === "Escape" || event.key === "Enter") close();
            };

            root.appendChild(overlay);
            requestAnimationFrame(() => overlay.classList.add("visible"));
            document.addEventListener("keydown", onKeydown);

            overlay.addEventListener("click", (event) => {
                if (event.target === overlay) close();
            });

            overlay.querySelector(".confirm").addEventListener("click", close);
            overlay.querySelector(".confirm").focus();
        });
    }



    function messageHasContent(message) {

        return (message.mensagem && message.mensagem.trim() !== "") || message.anexo_url;

    }



    function buildAttachmentHtml(message) {

        if (!message.anexo_url) return "";



        const url = escapeHtml(message.anexo_url);

        const nome = escapeHtml(message.anexo_nome || "Anexo");



        if (message.tipo === "image") {

            return `<a href="${url}" target="_blank" rel="noopener noreferrer" class="chat-anexo-imagem"><img src="${url}" alt="${nome}"></a>`;

        }



        if (message.tipo === "video") {

            return `<video class="chat-anexo-video" controls preload="metadata"><source src="${url}"></video>`;

        }



        return `<a href="${url}" target="_blank" rel="noopener noreferrer" class="chat-anexo-ficheiro"><i class="fa-solid fa-paperclip"></i> ${nome}</a>`;

    }



    function buildActionsHtml(message) {
        if (!message.mine) return "";

        return `
            <div class="chat-bubble-actions">
                <button type="button" class="chat-action-btn" data-action="edit" data-id="${message.id}" title="Editar">
                    <i class="fa-solid fa-pen"></i>
                </button>
                <button type="button" class="chat-action-btn" data-action="delete" data-id="${message.id}" title="Apagar">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>
        `;
    }

    function getBubblePlainText(bubble) {
        const textEl = bubble.querySelector(".chat-bubble-text");
        if (!textEl) return "";

        const clone = textEl.cloneNode(true);
        clone.querySelectorAll("br").forEach((br) => br.replaceWith("\n"));

        return clone.textContent || "";
    }

    function buildBubbleTextHtml(text) {
        return `<div class="chat-bubble-text">${escapeHtml(text).replace(/\n/g, "<br>")}</div>`;
    }

    function renderMessage(message) {

        if (!messageHasContent(message)) {

            return null;

        }



        const bubble = document.createElement("div");

        const sideClass = message.mine ? "mine" : "theirs";

        const row = document.createElement("div");

        row.className = `chat-row ${sideClass}`;

        row.dataset.autor = message.autor || "user";

        bubble.className = `chat-bubble ${sideClass}`;

        bubble.dataset.id = message.id;

        bubble.dataset.autor = message.autor;



        let bodyHtml = buildAttachmentHtml(message);

        if (message.mensagem && message.mensagem.trim() !== "") {

            bodyHtml += `<div class="chat-bubble-text">${escapeHtml(message.mensagem).replace(/\n/g, "<br>")}</div>`;

        }



        const readReceipt = message.mine && message.visualizada

            ? `<span class="chat-read-receipt">Mensagem visualizada</span>`

            : "";



        bubble.innerHTML = `
            ${buildActionsHtml(message)}
            ${bodyHtml}
            <div class="chat-bubble-meta">
                <span class="chat-bubble-time">${message.hora || ""}</span>
                ${readReceipt}
            </div>
        `;



        row.appendChild(bubble);

        return row;

    }



    function updateReadReceipts(container, visualizedIds) {

        if (!Array.isArray(visualizedIds)) return;



        visualizedIds.forEach((id) => {

            const bubble = container.querySelector(`[data-id="${id}"]`);

            if (!bubble || !bubble.classList.contains("mine")) return;



            const meta = bubble.querySelector(".chat-bubble-meta");

            if (!meta || meta.querySelector(".chat-read-receipt")) return;



            const receipt = document.createElement("span");

            receipt.className = "chat-read-receipt";

            receipt.textContent = "Mensagem visualizada";

            meta.appendChild(receipt);

        });

    }



    function appendMessages(container, messages) {

        let added = false;



        messages.forEach((message) => {

            if (!messageHasContent(message)) return;

            if (container.querySelector(`[data-id="${message.id}"]`)) return;



            const bubble = renderMessage(message);

            if (bubble) {

                container.appendChild(bubble);

                added = true;

            }

        });



        if (added) {

            scrollChatToBottom(container);

        }

    }



    function showBrowserNotification(title, body, link) {

        if (!("Notification" in window) || Notification.permission !== "granted") {

            return;

        }



        const notification = new Notification(title, {

            body,

            icon: "IMAGENS/favicon.png",

        });



        notification.onclick = () => {

            window.focus();

            if (link) window.location.href = link;

            notification.close();

        };

    }



    window.initChat = function initChat(options) {

        const container = document.getElementById(options.messagesId);

        const form = document.getElementById(options.formId);

        const input = document.getElementById(options.inputId);

        const sendBtn = document.getElementById(options.sendBtnId);

        const fileInput = document.getElementById(options.fileInputId || "chat-file");

        const filePreview = document.getElementById(options.filePreviewId || "chat-file-preview");

        const conversaId = options.conversaId;

        const viewerRole = options.viewerRole || "user";

        let lastId = options.lastId || 0;

        let sending = false;

        let selectedFile = null;

        let activeEdit = null;

        function closeInlineEdit(restore = true) {
            if (!activeEdit) return;

            const { bubble, editWrap, originalText } = activeEdit;

            if (restore && bubble?.isConnected && editWrap?.isConnected) {
                bubble.classList.remove("is-editing");
                bubble.querySelector(".chat-bubble-actions")?.removeAttribute("hidden");

                if (originalText !== "") {
                    editWrap.outerHTML = buildBubbleTextHtml(originalText);
                } else {
                    editWrap.remove();
                }
            }

            activeEdit = null;
        }

        function openInlineEdit(bubble, messageId) {
            const textEl = bubble.querySelector(".chat-bubble-text");
            if (!textEl || bubble.classList.contains("is-editing")) return;

            closeInlineEdit(true);

            const originalText = getBubblePlainText(bubble);

            bubble.classList.add("is-editing");
            bubble.querySelector(".chat-bubble-actions")?.setAttribute("hidden", "");

            const editWrap = document.createElement("div");
            editWrap.className = "chat-bubble-edit";

            const textarea = document.createElement("textarea");
            textarea.className = "chat-bubble-edit-input";
            textarea.rows = 3;
            textarea.value = originalText;
            textarea.setAttribute("aria-label", "Editar mensagem");

            const actions = document.createElement("div");
            actions.className = "chat-bubble-edit-acoes";
            actions.innerHTML = `
                <button type="button" class="chat-edit-btn cancel">Cancelar</button>
                <button type="button" class="chat-edit-btn save">Guardar</button>
            `;

            editWrap.appendChild(textarea);
            editWrap.appendChild(actions);
            textEl.replaceWith(editWrap);

            activeEdit = { bubble, messageId, editWrap, originalText, textarea };

            textarea.focus();
            textarea.setSelectionRange(textarea.value.length, textarea.value.length);
        }

        async function saveInlineEdit() {
            if (!activeEdit) return;

            const { bubble, messageId, textarea } = activeEdit;
            const texto = textarea.value.trim();
            const hasAttachment = bubble.querySelector(
                ".chat-anexo-imagem, .chat-anexo-video, .chat-anexo-ficheiro"
            );

            if (!texto && !hasAttachment) {
                alert("A mensagem nao pode ficar vazia.");
                return;
            }

            const saveBtn = bubble.querySelector(".chat-edit-btn.save");
            if (saveBtn) saveBtn.disabled = true;

            try {
                const body = new FormData();
                body.append("mensagem_id", messageId);
                body.append("mensagem", texto);

                const response = await fetch("chat_editar.php", {
                    method: "POST",
                    body,
                });
                const data = await response.json();

                if (!data.ok || !data.mensagem) {
                    alert(data.erro || "Nao foi possivel editar a mensagem.");
                    return;
                }

                activeEdit = null;

                const updated = renderMessage(data.mensagem);
                if (updated) {
                    const currentBubble = bubble.closest(".chat-row") || bubble;
                    currentBubble.replaceWith(updated);
                }
            } catch (error) {
                alert("Nao foi possivel editar a mensagem.");
            } finally {
                if (saveBtn) saveBtn.disabled = false;
            }
        }



        if (!container || !form || !input || !conversaId) {

            return;

        }



        scrollChatToBottom(container);



        if ("Notification" in window && Notification.permission === "default") {

            Notification.requestPermission();

        }



        function clearFileSelection() {

            selectedFile = null;

            if (fileInput) fileInput.value = "";

            if (filePreview) {

                filePreview.hidden = true;

                filePreview.textContent = "";

            }

        }



        if (fileInput) {

            fileInput.addEventListener("change", () => {

                selectedFile = fileInput.files && fileInput.files[0] ? fileInput.files[0] : null;

                if (filePreview) {

                    if (selectedFile) {

                        filePreview.hidden = false;

                        filePreview.textContent = selectedFile.name;

                    } else {

                        filePreview.hidden = true;

                        filePreview.textContent = "";

                    }

                }

            });

        }



        async function fetchMessages(isPoll = false) {

            try {

                const response = await fetch(`chat_obter.php?conversa_id=${conversaId}&desde_id=${lastId}`, {

                    headers: { Accept: "application/json" },

                });

                const data = await response.json();



                if (!data.ok) return;



                if (Array.isArray(data.visualizadas)) {

                    updateReadReceipts(container, data.visualizadas);

                }



                if (!Array.isArray(data.mensagens) || data.mensagens.length === 0) {

                    return;

                }



                const incoming = data.mensagens.filter((msg) => !msg.mine);
                appendMessages(container, data.mensagens);
                lastId = data.mensagens[data.mensagens.length - 1].id;

            } catch (error) {

                console.error(error);

            }

        }



        async function sendMessage(event) {

            event.preventDefault();



            const mensagem = input.value.trim();

            if ((!mensagem && !selectedFile) || sending || input.disabled) {

                return;

            }



            sending = true;

            if (sendBtn) sendBtn.disabled = true;



            try {

                const body = new FormData();

                body.append("conversa_id", conversaId);

                body.append("mensagem", mensagem);

                if (selectedFile) {

                    body.append("anexo", selectedFile);

                }



                const response = await fetch("chat_enviar.php", {

                    method: "POST",

                    body,

                });

                const data = await response.json();



                if (data.ok && data.mensagem) {

                    input.value = "";

                    clearFileSelection();

                    const empty = document.getElementById("chat-empty");

                    if (empty) empty.remove();

                    appendMessages(container, [data.mensagem]);

                    lastId = data.mensagem.id;

                } else if (data.erro) {

                    alert(data.erro);

                }

            } catch (error) {

                alert("Nao foi possivel enviar a mensagem.");

            } finally {

                sending = false;

                if (sendBtn) sendBtn.disabled = false;

                input.focus();

            }

        }



        form.addEventListener("submit", sendMessage);

        async function deleteMessage(messageId) {
            const confirmed = await showChatConfirm({
                title: "Apagar mensagem",
                message: "Esta acao e permanente. A mensagem sera removida da conversa.",
                confirmText: "Apagar mensagem",
                cancelText: "Cancelar",
                variant: "danger",
                icon: "fa-trash-can",
            });
            if (!confirmed) return;

            try {
                const body = new FormData();
                body.append("mensagem_id", messageId);

                const response = await fetch("chat_apagar_mensagem.php", {
                    method: "POST",
                    body,
                });
                const data = await response.json();

                if (!data.ok) {
                    await showChatNotice(data.erro || "Nao foi possivel apagar a mensagem.", {
                        title: "Erro ao apagar",
                        variant: "danger",
                        icon: "fa-triangle-exclamation",
                    });
                    return;
                }

                const bubble = container.querySelector(`[data-id="${messageId}"]`);
                if (bubble) {
                    const row = bubble.closest(".chat-row");
                    (row || bubble).remove();
                }

                if (!container.querySelector(".chat-bubble") && !document.getElementById("chat-empty")) {
                    const empty = document.createElement("div");
                    empty.className = "chat-empty";
                    empty.id = "chat-empty";
                    empty.textContent = "Esta conversa ainda nao tem mensagens.";
                    container.appendChild(empty);
                }
            } catch (error) {
                await showChatNotice("Nao foi possivel apagar a mensagem. Tenta novamente.", {
                    title: "Erro de ligacao",
                    variant: "danger",
                    icon: "fa-triangle-exclamation",
                });
            }
        }

        container.addEventListener("click", (event) => {
            const editBtn = event.target.closest(".chat-edit-btn");
            if (editBtn) {
                if (editBtn.classList.contains("save")) {
                    saveInlineEdit();
                } else if (editBtn.classList.contains("cancel")) {
                    closeInlineEdit(true);
                }
                return;
            }

            const button = event.target.closest(".chat-action-btn");
            if (!button) return;

            const messageId = button.dataset.id;
            const bubble = button.closest(".chat-bubble");
            if (!messageId || !bubble) return;

            if (button.dataset.action === "edit") {
                openInlineEdit(bubble, messageId);
            }

            if (button.dataset.action === "delete") {
                if (activeEdit?.bubble === bubble) {
                    closeInlineEdit(false);
                }
                deleteMessage(messageId);
            }
        });

        container.addEventListener("keydown", (event) => {
            if (!activeEdit) return;

            if (event.key === "Escape") {
                event.preventDefault();
                closeInlineEdit(true);
            }

            if (event.key === "Enter" && (event.ctrlKey || event.metaKey)) {
                event.preventDefault();
                saveInlineEdit();
            }
        });

        input.addEventListener("keydown", (event) => {

            if (event.key === "Enter" && !event.shiftKey) {

                event.preventDefault();

                form.requestSubmit();

            }

        });



        fetchMessages(false);

        setInterval(() => fetchMessages(true), 4000);

    };



    window.initChatNotifications = function initChatNotifications(options) {
        if (window.__chatNotifyStarted) return;
        window.__chatNotifyStarted = true;

        const badge = document.getElementById(options.badgeId || "chat-notify-badge");

        const link = options.chatLink || (options.isAdmin ? "responder_mensagem.php" : "minhas_mensagens.php");

        let lastCount = 0;



        async function pollNotifications() {

            try {

                const response = await fetch("chat_notificacoes.php", {

                    headers: { Accept: "application/json" },

                });

                const data = await response.json();

                if (!data.ok) return;



                const count = parseInt(data.nao_lidas, 10) || 0;



                if (badge) {

                    if (count > 0) {

                        badge.hidden = false;

                        badge.textContent = count > 99 ? "99+" : String(count);

                    } else {

                        badge.hidden = true;

                    }

                }



                if (count > lastCount && count > 0) {
                    const onChatPage =
                        window.location.pathname.includes("minhas_mensagens.php") ||
                        window.location.pathname.includes("responder_mensagem.php") ||
                        window.location.pathname.includes("admin_mensagens.php");

                    if (!onChatPage) {
                        const targetLink =
                            options.isAdmin && data.conversa_id
                                ? `responder_mensagem.php?conversa=${data.conversa_id}`
                                : link;
                        showBrowserNotification(
                            data.titulo || "Nova mensagem",
                            data.preview || "Tens uma nova mensagem.",
                            targetLink
                        );
                    }
                }



                lastCount = count;

            } catch (error) {

                console.error(error);

            }

        }



        if ("Notification" in window && Notification.permission === "default") {

            Notification.requestPermission();

        }



        pollNotifications();

        setInterval(pollNotifications, 8000);

    };

})();

