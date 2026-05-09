<?php include '../app/views/layouts/header.php'; ?>
<?php include '../app/views/layouts/sidebar.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Recruiter Dashboard</h1>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Consultants</h5>
                    <p class="card-text h3" id="total-consultants">0</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Active Submissions</h5>
                    <p class="card-text h3" id="active-submissions">0</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Upcoming Interviews</h5>
                    <p class="card-text h3" id="upcoming-interviews">0</p>
                </div>
            </div>
        </div>
    </div>

    <h3>Recent Submissions</h3>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>Consultant</th>
                    <th>Company</th>
                    <th>Job Title</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody id="recent-submissions-table">
                <!-- Data will be loaded via AJAX -->
            </tbody>
        </table>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', async () => {
        const consultants = await apiRequest('/consultant/index');
        const submissions = await apiRequest('/jobsubmission/index');

        document.getElementById('total-consultants').innerText = consultants.length || 0;
        document.getElementById('active-submissions').innerText = submissions.length || 0;

        const tableBody = document.getElementById('recent-submissions-table');
        submissions.forEach(sub => {
            const row = `<tr>
                <td>${sub.consultant_name} ${sub.consultant_last_name}</td>
                <td>${sub.company_name}</td>
                <td>${sub.job_title}</td>
                <td><span class="badge bg-info">${sub.status}</span></td>
                <td>${new Date(sub.created_at).toLocaleDateString()}</td>
            </tr>`;
            tableBody.innerHTML += row;
        });
    });
</script>

<?php include '../app/views/layouts/footer.php'; ?>
