        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Common AJAX Handler
    async function apiRequest(url, method = 'GET', data = null) {
        const token = localStorage.getItem('token');
        const options = {
            method,
            headers: {
                'Authorization': `Bearer ${token}`
            }
        };
        if (data) {
            options.body = data instanceof FormData ? data : JSON.stringify(data);
            if (!(data instanceof FormData)) {
                options.headers['Content-Type'] = 'application/json';
            }
        }
        const response = await fetch(url, options);
        return await response.json();
    }
</script>
</body>
</html>
