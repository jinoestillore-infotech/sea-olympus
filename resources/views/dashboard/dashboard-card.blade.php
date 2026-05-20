<style>
    .card-count {
        cursor: pointer;
        transition: 0.2s ease-in-out;
    }

    .card-count:hover {
        background-color: #faf6f6 !important;
        transform: translateY(-3px);
    }
</style>

<div class="row g-3 mb-4">
    <div class="col-12 col-sm-3">
        <div class="card card-count shadow-sm border text-center py-3" data-type="announcements" data-bs-toggle="modal"
            data-bs-target="#dashboardModal">
            <i class="bi bi-megaphone-fill fs-2 text-danger mb-2"></i>
            <p class="fs-3 mb-0">{{ $announcement }}</p>
            <h5 class="fw-bold text-danger">Announcements</h5>
        </div>
    </div>
    <div class="col-12 col-sm-3">
        <div class="card card-count shadow-sm border text-center py-3" data-type="users" data-bs-toggle="modal"
            data-bs-target="#dashboardModal">
            <i class="bi bi-people-fill fs-2 text-danger mb-2"></i>
            <p class="fs-3 mb-0">{{ $users }}</p>
            <h5 class="fw-bold text-danger">Users</h5>
        </div>
    </div>
    <div class="col-12 col-sm-3">
        <div class="card card-count shadow-sm border text-center py-3" data-type="holidays" data-bs-toggle="modal"
            data-bs-target="#dashboardModal">
            <i class="bi bi-calendar-check-fill fs-2 text-danger mb-2"></i>
            <p class="fs-3 mb-0">{{ $holidaysCount }}</p>
            <h5 class="fw-bold text-danger">Holidays</h5>
        </div>
    </div>
    <div class="col-12 col-sm-3">
        <div class="card card-count shadow-sm border text-center py-3" data-type="nonOperating" data-bs-toggle="modal"
            data-bs-target="#dashboardModal">
            <i class="bi bi-calendar-x-fill fs-2 text-danger mb-2"></i>
            <p class="fs-3 mb-0">{{ $nonOperatingCount }}</p>
            <h5 class="fw-bold text-danger">Non-Operating Days</h5>
        </div>
    </div>
    <div class="col-12 col-sm-3">
        <div class="card card-count shadow-sm border text-center py-3" data-type="departments" data-bs-toggle="modal"
            data-bs-target="#dashboardModal">
            <i class="bi bi-building-fill fs-2 text-danger mb-2"></i>
            <p class="fs-3 mb-0">{{ $departmentsCount }}</p>
            <h5 class="fw-bold text-danger">Departments</h5>
        </div>
    </div>
    <div class="col-12 col-sm-3">
        <div class="card card-count shadow-sm border text-center py-3" data-type="employees" data-bs-toggle="modal"
            data-bs-target="#dashboardModal">
            <i class="bi bi-person-fill-exclamation fs-2 text-danger mb-2"></i>
            <p class="fs-3 mb-0">{{ $employeesCount }}</p>
            <h5 class="fw-bold text-danger">Employees</h5>
        </div>
    </div>
</div>

<script>

    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
    }

    document.addEventListener('DOMContentLoaded', function () {

        const modalTitle = document.getElementById('modalTitle');
        const modalBody = document.getElementById('modalBody');

        const data = {
            announcements: @json($announcementsList),
            users: @json($usersList),
            holidays: @json($holidaysList),
            nonOperating: @json($nonOperatingList),
            departments: @json($departmentsList),
            employees: @json($employeesList)
        };

        document.querySelectorAll('.card-count').forEach(card => {
            card.addEventListener('click', function () {

                window.employeesRendered = false;
                const type = this.getAttribute('data-type');
                const title = this.querySelector('h5').textContent;

                modalTitle.innerHTML = `<strong>${title}</strong> [ ${data[type].length} ]`;

                if (!data[type] || data[type].length === 0) {
                    modalBody.innerHTML = `<div class="text-center py-4 text-muted">No records found.</div>`;
                    return;
                }

                let html = '<div class="row g-3">';

                data[type].forEach(item => {

                    if (type === 'announcements') {
                        html += `
                        <div class="col-12 col-md-6">
                            <div class="card shadow-sm h-100">
                                <div class="card-body">
                                    <h6 class="card-title fw-bold text-danger">${item.title}</h6>
                                    <p class="card-text text-muted">${item.description ?? ''}</p>
                                </div>
                            </div>
                        </div>
                    `;
                    } else if (type === 'users') {
                        html += `
                        <div class="col-12 col-md-6">
                            <div class="card shadow-sm h-100">
                                <div class="card-body">
                                    <h6 class="card-title fw-bold text-danger mb-0">${item.name}</h6>
                                    <p class="card-text text-muted mt-0">${item.email}</p>
                                </div>
                            </div>
                        </div>
                    `;
                    } else if (type === 'holidays' || type === 'nonOperating') {
                        const formattedDate = item.date ? formatDate(item.date) : '';
                        html += `
                        <div class="col-12 col-md-4">
                            <div class="card shadow-sm h-100">
                                <div class="card-body text-center">
                                    <h6 class="card-title fw-bold text-danger">
                                        ${item.name ?? item.title} ${formattedDate ? `<br><small class="text-muted">${formattedDate}</small>` : ''}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    `;
                    } else if (type === 'departments') {
                        html += `<div class="col-12 col-md-6">
                                <div class="card shadow-sm h-100">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold text-danger mb-0">${item.name}</h5>
                                        <p class="card-text text-muted mt-0 small">
                                            ${item.description ?? '—'}<br>
                                            Employees: ${item.employees ? item.employees.length : 0}
                                        </p>
                                    </div>
                                </div>
                            </div>`;
                    } else if (type === 'employees') {

                            if (window.employeesRendered) return; // prevent repeating
                            window.employeesRendered = true;

                            // Group employees by department name
                            const grouped = data.employees.reduce((acc, emp) => {

                                const deptName = emp.department && emp.department.name
                                    ? emp.department.name
                                    : 'No Department';

                                if (!acc[deptName]) {
                                    acc[deptName] = [];
                                }

                                acc[deptName].push(emp);

                                return acc;

                            }, {});

                            Object.keys(grouped).sort().forEach(dept => {

                                html += `
                                <div class="col-12">
                                    <h5 class="fw-bold text-danger mt-3 mb-3">
                                        ${dept}
                                        <small class="text-muted">[ ${grouped[dept].length} ]</small>
                                    </h5>
                                </div>
                                `;

                                grouped[dept].forEach(emp => {

                                    html += `
                                    <div class="col-12 col-md-6">
                                        <div class="card shadow-sm h-100 border">
                                            <div class="card-body">

                                                <h5 class="fw-bold text-danger mb-2">
                                                    ${emp.first_name ?? ''} ${emp.last_name ?? ''}
                                                </h5>

                                                <p class="text-muted m-0">
                                                    <strong>Email:</strong> ${emp.email ?? '—'}
                                                </p>

                                                <p class="text-muted m-0">
                                                    <strong>Position:</strong> ${emp.position ?? '—'}
                                                </p>

                                                <p class="text-muted small mb-0">
                                                    <strong>Status:</strong> ${emp.status ?? '—'}
                                                </p>

                                            </div>
                                        </div>
                                    </div>
                                    `;

                                });

                            });

                        }

                });

                html += '</div>';
                modalBody.innerHTML = html;

            });
        });

    });

</script>