@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">
    <div class="row h-100">
        <!-- LEFT PANEL -->
        <div class="mb-4">
            <div class="card shadow-sm h-100" id="leftPanel">
                <div class="card-header pb-0">
                    <h6 class="mb-0">Request Builder</h6>
                </div>

                <div class="card-body">
                    <form id="requestForm">

                        <!-- METHOD + URL -->
                        <div class="row mb-3">
                            <div class="col-2">
                                <select id="method" class="form-control styled-input">
                                    <option>GET</option>
                                    <option>POST</option>
                                    <option>PUT</option>
                                    <option>PATCH</option>
                                    <option>DELETE</option>
                                </select>
                            </div>

                            <div class="col-10">
                                <input type="text" id="url" class="form-control styled-input"
                                    placeholder="https://jsonplaceholder.typicode.com/posts/1">
                            </div>
                        </div>

                        <!-- HEADERS (ADVANCED) -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label class="form-label mb-1">Headers</label>
                                <small class="text-muted">Content-Type & Authorization</small>
                            </div>

                            <select id="contentType" class="form-control styled-input mb-2">
                                <option value="">-- Content-Type --</option>
                                <option value="application/json">JSON (application/json)</option>
                                <option value="application/x-www-form-urlencoded">Form URL Encoded</option>
                                <option value="multipart/form-data">Multipart Form Data</option>
                            </select>

                            <div class="d-flex gap-2">
                                <select id="authType" class="form-control styled-input">
                                    <option value="">-- Authorization --</option>
                                    <option value="bearer">Bearer Token</option>
                                </select>

                                <input type="text"
                                    id="authToken"
                                    class="form-control styled-input"
                                    placeholder="Bearer token..."
                                    disabled>
                            </div>
                        </div>

                        <!-- BODY -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label class="form-label mb-1">Body (JSON / raw)</label>
                                <button id="formatJsonBtn" type="button"
                                    class="btn btn-link text-primary p-0 small">
                                    Pretty JSON
                                </button>
                            </div>

                            <textarea id="body" class="form-control styled-input"
                                rows="7"
                                placeholder='{"title": "foo", "body": "bar", "userId": 1}'></textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary py-2">
                                Send Request
                            </button>

                            <button id="clearFormBtn" type="button"
                                class="btn btn-outline-secondary py-2">
                                Clear Form
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- RIGHT PANEL -->
        <div>
            <div class="card shadow-sm h-100" id="rightPanel">
                <div class="card-header pb-0">
                    <h6 class="mb-0">Response</h6>
                </div>

                <div class="card-body d-flex flex-column">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="border rounded p-3 bg-light">
                                <small class="text-muted">Status</small>
                                <p id="statusCode" class="fw-bold mb-0">-</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="border p-3 bg-light">
                                <small class="text-muted">Info</small>
                                <p id="infoText" class="fw-bold mb-0">Waiting…</p>
                            </div>
                        </div>
                    </div>

                    <label class="form-label">Response Body</label>
                    <pre id="responseBody"
                        class="bg-dark text-success p-3 rounded overflow-auto flex-grow-1"
                        style="height: 250px;">No response yet.</pre>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
/* ================= HEADER BUILDER ================= */
function buildHeadersData() {
    const headers = {};

    const ct = document.getElementById('contentType').value;
    if (ct) headers['Content-Type'] = ct;

    const authType = document.getElementById('authType').value;
    const token = document.getElementById('authToken').value.trim();
    if (authType === 'bearer' && token) {
        headers['Authorization'] = `Bearer ${token}`;
    }

    return headers;
}

document.getElementById('authType').addEventListener('change', e => {
    document.getElementById('authToken').disabled = e.target.value !== 'bearer';
});

/* ================= PRETTY JSON ================= */
document.getElementById('formatJsonBtn').addEventListener('click', () => {
    const textarea = document.getElementById('body');
    if (!textarea.value.trim()) return;
    try {
        textarea.value = JSON.stringify(JSON.parse(textarea.value), null, 2);
    } catch {
        alert('Body bukan JSON valid.');
    }
});

/* ================= CLEAR FORM ================= */
document.getElementById('clearFormBtn').addEventListener('click', () => {
    document.getElementById('method').value = 'GET';
    document.getElementById('url').value = '';
    document.getElementById('body').value = '';
    document.getElementById('contentType').value = '';
    document.getElementById('authType').value = '';
    document.getElementById('authToken').value = '';
    document.getElementById('authToken').disabled = true;
});

/* ================= SEND REQUEST ================= */
document.getElementById('requestForm').addEventListener('submit', async (e) => {
    e.preventDefault();

    const method = document.getElementById('method').value;
    const url = document.getElementById('url').value.trim();
    const headers_data = buildHeadersData();
    const body = document.getElementById('body').value;

    if (!url) return alert('URL tidak boleh kosong.');

    document.getElementById('infoText').textContent = 'Sending...';
    document.getElementById('statusCode').textContent = '-';

    try {
        const res = await fetch('/api/send', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ method, url, headers_data, body })
        });

        const data = await res.json();

        document.getElementById('statusCode').textContent = data.status ?? '-';
        document.getElementById('infoText').textContent =
            data.status === 0 ? 'Request error' : 'Request completed';

        let text = data.body ?? '';
        try { text = JSON.stringify(JSON.parse(text), null, 2); } catch {}
        document.getElementById('responseBody').textContent = text || 'No response body.';

        loadHistory();
    } catch (err) {
        document.getElementById('statusCode').textContent = 'ERR';
        document.getElementById('infoText').textContent = 'Failed';
        document.getElementById('responseBody').textContent = err.message;
    }
});

/* ================= HISTORY (LAMA, TETAP) ================= */
async function loadHistory() {
        try {
            const res = await fetch('/api/history');
            const list = await res.json();

            const container = document.getElementById('historyList');
            container.innerHTML = '';

            if (!list.length) {
                container.innerHTML = '<p class="text-gray-500">Belum ada history.</p>';
                return;
            }

            list.forEach(item => {
                const row = document.createElement('div');
                row.className = 'history-item';

                const methodBadge = {
                    GET: 'badge bg-info',
                    POST: 'badge bg-primary',
                    PUT: 'badge bg-warning',
                    PATCH: 'badge bg-secondary',
                    DELETE: 'badge bg-danger'
                };

                const mainBtn = document.createElement('button');
                mainBtn.type = 'button';
                mainBtn.className =
                    'history-main btn btn-link text-start mt-3';
                mainBtn.innerHTML = `
        <span class="${methodBadge[item.method] || 'badge bg-dark'}">
            ${item.method}
        </span>
        <span class="history-url fw-semibold">
            ${item.url_short}
        </span>
    `;
                mainBtn.onclick = () => loadHistoryItem(item.id);

                const deleteBtn = document.createElement('button');
                deleteBtn.type = 'button';
                deleteBtn.className =
                    'history-delete btn btn-sm btn-outline-danger mt-3';
                deleteBtn.innerHTML = 'Hapus';
                deleteBtn.onclick = (e) => {
                    e.stopPropagation();
                    deleteHistory(item.id);
                };

                row.appendChild(mainBtn);
                row.appendChild(deleteBtn);

                container.appendChild(row);
            });

        } catch (e) {
            console.error(e);
        }
    }

    // klik history → isi form dan response
    async function loadHistoryItem(id) {
        try {
            const res = await fetch(`/api/history/${id}`);
            const item = await res.json();

            document.getElementById('method').value = item.method;
            document.getElementById('url').value = item.url;
            document.getElementById('headers_data').value = (item.headers && typeof item.headers === 'object') ?
                Object.entries(item.headers).map(([k, v]) => `${k}: ${v}`).join('\n') :
                '';
            document.getElementById('body').value = item.body ?? '';

            document.getElementById('statusCode').textContent = item.response_status ?? '-';
            let text = item.response_body ?? '';
            try {
                const parsed = JSON.parse(text);
                text = JSON.stringify(parsed, null, 2);
            } catch (e) {}
            document.getElementById('responseBody').textContent = text || 'No response body.';
            document.getElementById('infoText').textContent = 'Loaded from history';
        } catch (e) {
            console.error(e);
        }
    }

    // hapus satu history
    async function deleteHistory(id) {
        if (!confirm('Hapus history ini?')) return;

        try {
            await fetch(`/api/history/${id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json'
                }
            });

            loadHistory();
        } catch (e) {
            console.error(e);
            alert('Gagal menghapus history');
        }
    }

    /* ================= CLEAR ALL HISTORY ================= */
    const clearBtn = document.getElementById('clearHistoryBtn');
    if (clearBtn) {
        clearBtn.addEventListener('click', async () => {
            if (!confirm('Hapus semua history?')) return;

            await fetch('/api/history', {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json'
                }
            });

            loadHistory();
        });
    }
    // load history pertama kali
    loadHistory();
</script>

<style>
.styled-input {
    border: 1.5px solid #bbb;
    border-radius: 8px;
    padding: 10px 12px;
}
</style>

@endsection
