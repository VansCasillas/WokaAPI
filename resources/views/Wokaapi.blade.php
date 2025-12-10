<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>WokaAPI Tester</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-7xl mx-auto p-4 md:p-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl md:text-3xl font-bold">WokaAPI – Mini Postman</h1>
            <button id="darkToggle"
                class="text-sm px-3 py-2 rounded-lg border border-gray-300 hover:bg-gray-200">
                Toggle Dark
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- LEFT: REQUEST BUILDER -->
            <div id="leftPanel" class="bg-white rounded-2xl shadow p-4 md:p-6">
                <h2 class="text-lg font-semibold mb-4">Request Builder</h2>

                <form id="requestForm" class="space-y-4">

                    <!-- METHOD + URL -->
                    <div class="flex gap-2">
                        <select name="method" id="method"
                            class="border rounded-lg p-2 w-28 text-sm">
                            <option>GET</option>
                            <option>POST</option>
                            <option>PUT</option>
                            <option>PATCH</option>
                            <option>DELETE</option>
                        </select>
                        <input type="text" id="url" name="url"
                            class="border rounded-lg p-2 w-full text-sm"
                            placeholder="https://jsonplaceholder.typicode.com/posts/1">
                    </div>

                    <!-- HEADERS -->
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <h3 class="font-medium text-sm">Headers</h3>
                            <span class="text-xs text-gray-500">Format: Key: Value (satu per baris)</span>
                        </div>
                        <textarea id="headers_data" name="headers_data"
                            class="border rounded-lg p-3 w-full h-24 bg-gray-50 text-xs font-mono"
                            placeholder="Content-Type: application/json&#10;Authorization: Bearer token"></textarea>
                    </div>

                    <!-- BODY -->
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <h3 class="font-medium text-sm">Body (JSON / raw)</h3>
                            <button type="button"
                                id="formatJsonBtn"
                                class="text-xs text-blue-600 hover:underline">
                                Pretty JSON
                            </button>
                        </div>
                        <textarea id="body" name="body"
                            class="border rounded-lg p-3 w-full h-40 bg-gray-50 text-xs font-mono"
                            placeholder='{"title": "foo", "body": "bar", "userId": 1}'></textarea>
                    </div>

                    <!-- BUTTONS -->
                    <div class="flex flex-col md:flex-row gap-2">
                        <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm w-full md:w-auto hover:bg-blue-700">
                            Send Request
                        </button>
                        <button type="button" id="clearFormBtn"
                            class="border border-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm w-full md:w-auto hover:bg-gray-100">
                            Clear Form
                        </button>
                    </div>
                </form>
            </div>

            <!-- RIGHT: RESPONSE + HISTORY -->
            <div id="rightPanel" class="bg-white rounded-2xl shadow p-4 md:p-6">
                <h2 class="text-lg font-semibold mb-4">Response</h2>

                <!-- STATUS + TIME (time opsional, bisa diisi nanti di backend kalau mau) -->
                <div class="grid grid-cols-2 gap-3 mb-4">
                    <div class="bg-gray-100 rounded-lg p-3">
                        <p class="text-xs text-gray-600">Status</p>
                        <p id="statusCode" class="font-semibold text-sm">-</p>
                    </div>
                    <div class="bg-gray-100 rounded-lg p-3">
                        <p class="text-xs text-gray-600">Info</p>
                        <p id="infoText" class="font-semibold text-sm text-gray-700">Waiting…</p>
                    </div>
                </div>

                <!-- RESPONSE BODY -->
                <h3 class="font-medium text-sm mb-1">Response Body</h3>
                <pre id="responseBody"
                    class="bg-black text-green-400 rounded-lg p-3 h-64 overflow-auto text-xs font-mono whitespace-pre-wrap">
No response yet.
            </pre>

                <!-- HISTORY -->
                <div class="mt-6 flex items-center justify-between mb-2">
                    <h3 class="font-medium text-sm">History</h3>
                    <button type="button" id="clearHistoryBtn"
                        class="text-xs text-red-600 hover:underline">
                        Clear All
                    </button>
                </div>
                <div id="historyList"
                    class="bg-gray-50 rounded-lg p-3 h-40 overflow-auto text-xs space-y-1">
                    <p class="text-gray-500">Belum ada history.</p>
                </div>
            </div>

        </div>
    </div>

    <script>
        // toggle dark mode sederhana
        const body = document.body;
        const leftPanel = document.getElementById('leftPanel');
        const rightPanel = document.getElementById('rightPanel');
        document.getElementById('darkToggle').addEventListener('click', () => {
            body.classList.toggle('bg-gray-100');
            body.classList.toggle('bg-gray-900');
            body.classList.toggle('text-white');
            leftPanel.classList.toggle('bg-white');
            leftPanel.classList.toggle('bg-gray-800');
            rightPanel.classList.toggle('bg-white');
            rightPanel.classList.toggle('bg-gray-800');
        });

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
                    row.className = 'flex items-start justify-between gap-2';

                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'text-left flex-1 hover:underline';
                    btn.innerHTML = `<span class="font-semibold">${item.method}</span> ${item.url} <span class="text-gray-500">(${item.response_status ?? '-'})</span>`;
                    btn.onclick = () => loadHistoryItem(item.id);

                    const delBtn = document.createElement('button');
                    delBtn.type = 'button';
                    delBtn.className = 'text-red-600 text-xs hover:underline';
                    delBtn.textContent = 'Hapus';
                    delBtn.onclick = () => deleteHistory(item.id);

                    row.appendChild(btn);
                    row.appendChild(delBtn);
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

</body>

</html>