<?php include '../app/views/layouts/header.php'; ?>
<?php include '../app/views/layouts/sidebar.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manager Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="exportCSV()">Export Report</button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Team Performance</h5>
                    <canvas id="performanceChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Invite Link Management</h5>
                    <form id="invite-form">
                        <div class="mb-3">
                            <input type="email" class="form-control" id="invite-email" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <select class="form-select" id="invite-role" required>
                                <option value="3">Recruiter</option>
                                <option value="4">Consultant</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Generate Invite</button>
                    </form>
                    <div id="invite-result" class="mt-2"></div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const ctx = document.getElementById('performanceChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Recruiter A', 'Recruiter B', 'Recruiter C'],
                datasets: [{
                    label: 'Submissions',
                    data: [12, 19, 3],
                    backgroundColor: 'rgba(13, 110, 253, 0.5)'
                }]
            }
        });

        document.getElementById('invite-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const email = document.getElementById('invite-email').value;
            const role_id = document.getElementById('invite-role').value;

            const formData = new FormData();
            formData.append('email', email);
            formData.append('role_id', role_id);

            const result = await apiRequest('/invite/generate', 'POST', formData);
            if (result.link) {
                document.getElementById('invite-result').innerHTML = `<div class="alert alert-success small">Link: ${result.link}</div>`;
            } else {
                document.getElementById('invite-result').innerHTML = `<div class="alert alert-danger small">Error: ${result.error}</div>`;
            }
        });
    });

    function exportCSV() {
        alert('Exporting to CSV...');
    }
</script>

<?php include '../app/views/layouts/footer.php'; ?>
