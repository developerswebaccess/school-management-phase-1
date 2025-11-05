@if (!empty($alerts))
    @foreach ($alerts as $alert)
        <div class="alert alert-{{ $alert['type'] }} shadow-sm rounded-3">
            <strong>{{ $alert['title'] }}:</strong> {{ $alert['message'] }}
        </div>
    @endforeach
@endif
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
                                <h4 class="mb-0">{{ $stats['total_subjects'] }}</h4>
                            </div>
                            <p class="mb-1">Total Subjects</p>
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
                                <h4 class="mb-0">{{ $stats['in_progress_subjects'] }}</h4>
                            </div>
                            <p class="mb-1">Total Inprogress Subjects</p>
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
                                <h4 class="mb-0">{{ $stats['completed_subjects'] }}</h4>
                            </div>
                            <p class="mb-1">Total Completed Subjects</p>
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
                                <h4 class="mb-0">{{ $stats['total_attendance'] }}</h4>
                            </div>
                            <p class="mb-1">Total Attendance</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- View sales -->

<div class="col-md-12">
    <div class="row g-4">
        <div class="col-md-6">
            <canvas id="attendanceTrend"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="subjectProgress"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const attTrend = document.getElementById('attendanceTrend');
        new Chart(attTrend, {
            type: 'line',
            data: {
                labels: {!! json_encode($charts['attendance_trend']->pluck('date')->reverse()) !!},
                datasets: [{
                    label: 'Attendance',
                    data: {!! json_encode($charts['attendance_trend']->pluck('total')->reverse()) !!},
                    borderWidth: 2,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true
            }
        });

        new Chart(document.getElementById('subjectProgress'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($charts['subject_progress']->pluck('status')) !!},
                datasets: [{
                    data: {!! json_encode($charts['subject_progress']->pluck('total')) !!},
                    borderWidth: 1
                }]
            }
        });

        new Chart(document.getElementById('paymentSummary'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($charts['payments_summary']->pluck('payment_method')) !!},
                datasets: [{
                    label: 'Payments ($)',
                    data: {!! json_encode($charts['payments_summary']->pluck('total')) !!}
                }]
            }
        });
    });
</script>
