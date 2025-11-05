<!-- View sales -->
<div class="col-xl-6">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-7">
                        <div class="card-body text-nowrap">
                            <h5 class="card-title mb-0">Welcome {{ Auth::user()->name }}! 🎉</h5>
                            <p class="mb-2">Here what's happening in your account today</p>
                            <a href="{{ route('profile.index') }}" class="btn btn-primary">View Profile</a>
                        </div>
                    </div>
                    <div class="col-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{ asset('assets/img/illustrations/card-advance-sale.png') }}" height="140"
                                alt="view sales" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="row">
                <!-- Total Parents -->
                <div class="col-lg-6 col-sm-6 mt-2">
                    <div class="card card-border-shadow-primary h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="avatar me-4">
                                    <span class="avatar-initial rounded bg-label-primary">
                                        <i class="ti ti-users icon-28px"></i>
                                    </span>
                                </div>
                                <h4 class="mb-0">{{ $stats['total_classes'] }}</h4>
                            </div>
                            <p class="mb-1">Total Classes</p>
                        </div>
                    </div>
                </div>

                <!-- Total Enrolled Children -->
                <div class="col-lg-6 col-sm-6 mt-2">
                    <div class="card card-border-shadow-warning h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="avatar me-4">
                                    <span class="avatar-initial rounded bg-label-warning">
                                        <i class="ti ti-school icon-28px"></i>
                                    </span>
                                </div>
                                <h4 class="mb-0">{{ $stats['total_students'] }}</h4>
                            </div>
                            <p class="mb-1">Total Students</p>
                        </div>
                    </div>
                </div>

                <!-- Total Teachers -->
                <div class="col-lg-6 col-sm-6 mt-2">
                    <div class="card card-border-shadow-danger h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="avatar me-4">
                                    <span class="avatar-initial rounded bg-label-danger">
                                        <i class="ti ti-chalkboard icon-28px"></i>
                                    </span>
                                </div>
                                <h4 class="mb-0">{{ $stats['active_subjects'] }}</h4>
                            </div>
                            <p class="mb-1">Active Subjects</p>
                        </div>
                    </div>
                </div>

                <!-- Total Groups -->
                <div class="col-lg-6 col-sm-6 mt-2">
                    <div class="card card-border-shadow-info h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="avatar me-4">
                                    <span class="avatar-initial rounded bg-label-info">
                                        <i class="ti ti-users-group icon-28px"></i>
                                    </span>
                                </div>
                                <h4 class="mb-0">{{ $stats['active_groups'] }}</h4>
                            </div>
                            <p class="mb-1">Active Groups</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- View sales -->

<div class="col-md-12">
    {{-- Chart Section --}}
    <div class="row">
        <div class="col-md-6">
            <div class="card h-100 p-3">
                <h5>Students Per Class</h5>
                <canvas id="studentsPerClassChart"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100 p-3">
                <h5>Class Capacity Utilization</h5>
                <canvas id="classCapacityChart"></canvas>
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <div class="card h-100 p-3">
                <h5>Weekly Schedule Overview</h5>
                <canvas id="weeklyScheduleChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {

        // 📊 Students per Class
        const studentCtx = document.getElementById('studentsPerClassChart');
        new Chart(studentCtx, {
            type: 'bar',
            data: {
                labels: @json($charts['students_per_class']->pluck('name')),
                datasets: [{
                    label: 'Students',
                    data: @json($charts['students_per_class']->pluck('total')),
                }]
            },
            options: {
                responsive: true
            }
        });

        // 📈 Class Capacity Utilization
        const capacityCtx = document.getElementById('classCapacityChart');
        new Chart(capacityCtx, {
            type: 'doughnut',
            data: {
                labels: @json($charts['class_capacity']->pluck('name')),
                datasets: [{
                    label: 'Utilization (%)',
                    data: @json($charts['class_capacity']->pluck('utilization')),
                }]
            },
            options: {
                responsive: true
            }
        });

        // 🗓️ Weekly Schedule
        const weeklyCtx = document.getElementById('weeklyScheduleChart');
        new Chart(weeklyCtx, {
            type: 'line',
            data: {
                labels: @json($charts['weekly_schedule']->pluck('day')),
                datasets: [{
                    label: 'Classes Scheduled',
                    data: @json($charts['weekly_schedule']->pluck('count')),
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true
            }
        });
    });
</script>
