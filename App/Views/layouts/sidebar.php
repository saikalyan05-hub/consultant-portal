<div class="col-md-3 col-lg-2 d-md-block sidebar collapse">
    <div class="position-sticky pt-3">
        <h5 class="px-3 mb-4">Staffing Portal</h5>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="/dashboard">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/consultants">
                    <i class="bi bi-people me-2"></i> Consultants
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/submissions">
                    <i class="bi bi-file-earmark-text me-2"></i> Submissions
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/interviews">
                    <i class="bi bi-calendar-event me-2"></i> Interviews
                </a>
            </li>
            <hr>
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="logout()">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                </a>
            </li>
        </ul>
    </div>
</div>
<script>
    function logout() {
        localStorage.removeItem('token');
        window.location.href = '/login';
    }
</script>
