@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">
    <div class="row h-100">
        <!-- LEFT PANEL -->
        <div class="col-lg-6 mb-4">
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

                        <!-- HEADERS -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label class="form-label mb-1">Headers</label>
                                <small class="text-muted">Key: Value (satu per baris)</small>
                            </div>

                            <textarea id="headers_data" class="form-control styled-input"
                                rows="4" placeholder="Content-Type: application/json&#10;Authorization: Bearer token"></textarea>
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
                                rows="7" placeholder='{"title": "foo", "body": "bar", "userId": 1}'></textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary py-2">
                                Send Request
                            </button>

                            <button id="clearFormBtn" type="button" class="btn btn-outline-secondary py-2">
                                Clear Form
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- RIGHT PANEL -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm h-100" id="rightPanel">
                <div class="card-header pb-0">
                    <h6 class="mb-0">Response</h6>
                </div>

                <div class="card-body d-flex flex-column">
                    <!-- STATUS -->
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

                    <!-- RESPONSE BODY -->
                    <label class="form-label">Response Body</label>
                    <pre id="responseBody"
                        class="bg-dark text-success p-3 rounded overflow-auto flex-grow-1"
                        style="height: 250px;">No response yet.</pre>
                </div>
            </div>
        </div>
        <div>
            <div class="card shadow-sm p-3">
                <div class="card-body">
                    <!-- HISTORY -->
                    <div class="d-flex justify-content-between align-items-center mt-4 mb-2">
                        <h6 class="mb-0">History</h6>

                        <button id="clearHistoryBtn" class="btn btn-link text-danger small p-0">
                            Clear All
                        </button>
                    </div>

                    <div id="historyList"
                        class="border rounded p-3 bg-light"
                        style="height: 180px; overflow-y: auto;">
                        <p class="text-muted small">Belum ada history.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // pretty JSON untuk textarea body
    document.getElementById('formatJsonBtn').addEventListener('click', () => {
        const textarea = document.getElementById('body');
        const text = textarea.value.trim();
        if (!text) return;
        try {
            const obj = JSON.parse(text);
            textarea.value = JSON.stringify(obj, null, 2);
        } catch (e) {
            alert('Body bukan JSON valid.');
        }
    });

    // clear form
    document.getElementById('clearFormBtn').addEventListener('click', () => {
        document.getElementById('method').value = 'GET';
        document.getElementById('url').value = '';
        document.getElementById('headers_data').value = '';
        document.getElementById('body').value = '';
    });

    // kirim request ke backend /api/send
    document.getElementById('requestForm').addEventListener('submit', async (e) => {
        e.preventDefault();

        const method = document.getElementById('method').value;
        const url = document.getElementById('url').value.trim();
        const headers_data = document.getElementById('headers_data').value;
        const body = document.getElementById('body').value;

        if (!url) {
            alert('URL tidak boleh kosong.');
            return;
        }

        document.getElementById('infoText').textContent = 'Sending...';
        document.getElementById('statusCode').textContent = '-';

        try {
            const res = await fetch('/api/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    method,
                    url,
                    headers_data,
                    body
                })
            });

            const data = await res.json();

            // tampilkan status
            document.getElementById('statusCode').textContent = data.status ?? '-';
            document.getElementById('infoText').textContent = data.status === 0 ?
                'Request error' :
                'Request completed';

            // pretty JSON kalau bisa
            let text = data.body ?? '';
            try {
                const parsed = JSON.parse(text);
                text = JSON.stringify(parsed, null, 2);
            } catch (e) {
                // biarkan apa adanya
            }
            document.getElementById('responseBody').textContent = text || 'No response body.';

            // reload history
            loadHistory();

        } catch (err) {
            document.getElementById('statusCode').textContent = 'ERR';
            document.getElementById('infoText').textContent = 'Failed';
            document.getElementById('responseBody').textContent = err.message;
        }
    });

    // load history dari /api/history
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
                row.className = 'd-flex justify-content-between align-items-center';

                // METHOD badge
                const methodBadge = {
                    GET: 'badge bg-info',
                    POST: 'badge bg-primary',
                    PUT: 'badge bg-warning',
                    PATCH: 'badge bg-secondary',
                    DELETE: 'badge bg-danger'
                };

                const mainBtn = document.createElement('button');
                mainBtn.type = 'button';
                mainBtn.className = 'btn btn-link text-start p-0 flex-grow-1';
                mainBtn.innerHTML = `
        <span class="${methodBadge[item.method] || 'badge bg-dark'}">${item.method}</span>
        <strong class="ms-2">${item.url}</strong>
        <small class="text-muted ms-2">(${item.response_status ?? '-'})</small>`;
                mainBtn.onclick = () => loadHistoryItem(item.id);

                const deleteBtn = document.createElement('button');
                deleteBtn.type = 'button';
                deleteBtn.className = 'btn btn-sm btn-outline-danger';
                deleteBtn.textContent = 'Hapus';
                deleteBtn.onclick = () => deleteHistory(item.id);

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

        await fetch(`/api/history/${id}`, {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json'
            }
        });

        loadHistory();
    }

    // clear all history
    document.getElementById('clearHistoryBtn').addEventListener('click', async () => {
        if (!confirm('Hapus semua history?')) return;

        await fetch('/api/history', {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json'
            }
        });

        loadHistory();
    });

    // load history pertama kali
    loadHistory();
</script>

<style>
    /* 🔹 Styling input biar kotaknya jelas */
    .styled-input {
        border: 1.5px solid #bbb;
        border-radius: 8px;
        padding: 10px 12px;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .styled-input:focus {
        border-color: #000;
        box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.1);
        outline: none;
    }

    label {
        margin-bottom: 6px;
    }
</style>

</body>
@endsection