    <style>
        .wexnix_sidebar-calendar-grid .wexnix_cal-today,
        .wexnix_sidebar-calendar-grid .wexnix_cal-event {
            border-radius: 6px !important;
        }
        .wexnix_sidebar-calendar-head select {
            color: inherit;
            font-weight: bold;
            cursor: pointer;
            box-shadow: none !important;
            background-color: transparent !important;
            padding-right: 1.8rem !important; /* Extra padding for the dropdown arrow */
            font-size: inherit;
        }
        .wexnix_sidebar-calendar-head select:focus {
            outline: none;
            box-shadow: none;
        }
        .wexnix_sidebar-calendar-head button {
            color: inherit;
            opacity: 0.8;
        }
        .wexnix_sidebar-calendar-head button:hover {
            opacity: 1;
        }
    </style>
    <div class="wexnix_sidebar-widget h-100">
        <h4 class="wexnix_sidebar-widget-title"><i class="fas fa-calendar-alt"></i> {{ $siteSettings->sidebar_calendar_title ?: 'Academic Calendar' }}</h4>
        <div class="wexnix_sidebar-calendar" id="academicCalendarWidget">
            <div class="wexnix_sidebar-calendar-head d-flex justify-content-between align-items-center">
                <button type="button" id="acPrevMonth" class="btn btn-sm btn-link text-decoration-none p-1"><i class="fas fa-chevron-left"></i></button>
                <div class="d-flex justify-content-center align-items-center">
                    <select id="acMonthSelect" class="form-select form-select-sm border-0 w-auto pe-4 me-1">
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                    <select id="acYearSelect" class="form-select form-select-sm border-0 w-auto pe-4">
                    </select>
                </div>
                <button type="button" id="acNextMonth" class="btn btn-sm btn-link text-decoration-none p-1"><i class="fas fa-chevron-right"></i></button>
            </div>
            <div class="wexnix_sidebar-calendar-grid" id="acGrid">
                <!-- Populated by JS -->
            </div>
            <div class="wexnix_sidebar-calendar-legend">
                <span><span class="wexnix_dot wexnix_dot-today"></span> Today</span>
                <span><span class="wexnix_dot wexnix_dot-event"></span> Event</span>
            </div>
        </div>
    </div>
    
    <!-- Event Detail Modal -->
    <div class="modal fade" id="academicEventModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="academicEventModalLabel">Event Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6 id="modalEventDate" class="text-primary mb-2"></h6>
                    <h5 id="modalEventTitle" class="mb-3"></h5>
                    <span id="modalEventType" class="badge bg-secondary mb-3"></span>
                    <div id="modalEventDescription" class="text-muted"></div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function() {
            // Prevent multiple initializations if included multiple times
            if (window.academicCalendarInitialized) return;
            window.academicCalendarInitialized = true;

            let currentYear = {{ now()->year }};
            let currentMonth = {{ now()->month }};
            const lang = '{{ app()->getLocale() }}';
            let eventsData = [];

            function formatEventTypeName(type) {
                if (type === 'academic_event') return 'Academic Event';
                if (type === 'govt_holiday') return 'Govt Holiday';
                return 'Other';
            }

            function fetchEvents(year, month) {
                $.ajax({
                    url: '{{ route('api.academic-calendar.events') }}',
                    type: 'GET',
                    data: { year: year, month: month },
                    success: function(response) {
                        eventsData = response;
                        renderCalendar(year, month);
                    },
                    error: function() {
                        console.error('Failed to fetch events');
                        renderCalendar(year, month);
                    }
                });
            }

            function renderCalendar(year, month) {
                // Remove setting span text, we are using select now
                $('#acMonthSelect').val(month);
                $('#acYearSelect').val(year);

                let html = `
                    <span class="wexnix_cal-dow">Mo</span>
                    <span class="wexnix_cal-dow">Tu</span>
                    <span class="wexnix_cal-dow">We</span>
                    <span class="wexnix_cal-dow">Th</span>
                    <span class="wexnix_cal-dow">Fr</span>
                    <span class="wexnix_cal-dow">Sa</span>
                    <span class="wexnix_cal-dow">Su</span>
                `;

                const firstDay = new Date(year, month - 1, 1).getDay();
                // JS getDay() returns 0 for Sunday. Convert to 1(Mon)-7(Sun)
                let dayOfWeek = firstDay === 0 ? 7 : firstDay;
                const daysInMonth = new Date(year, month, 0).getDate();
                
                const todayDate = new Date();
                const isCurrentMonth = todayDate.getFullYear() === year && (todayDate.getMonth() + 1) === month;
                const todayDay = todayDate.getDate();

                for (let i = 1; i < dayOfWeek; i++) {
                    html += `<span class="wexnix_cal-day wexnix_cal-empty"></span>`;
                }

                for (let day = 1; day <= daysInMonth; day++) {
                    let isToday = isCurrentMonth && day === todayDay;
                    
                    // Check if day has an event
                    let dayDateString = `${year}-${String(month).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                    let dayEvents = eventsData.filter(e => e.date === dayDateString);
                    let hasEvent = dayEvents.length > 0;
                    
                    let classes = 'wexnix_cal-day';
                    if (isToday) classes += ' wexnix_cal-today';
                    if (hasEvent) classes += ' wexnix_cal-event" style="cursor: pointer;" data-date="' + dayDateString;

                    html += `<span class="${classes}">${day}</span>`;
                }

                $('#acGrid').html(html);

                // Bind click event for days with events
                $('.wexnix_cal-event').off('click').on('click', function() {
                    const dateStr = $(this).data('date');
                    const evs = eventsData.filter(e => e.date === dateStr);
                    if (evs.length > 0) {
                        const ev = evs[0];
                        const defaultLang = '{{ config('app.fallback_locale', 'en') }}';
                        
                        const title = ev.title[lang] || ev.title[defaultLang] || Object.values(ev.title)[0] || '';
                        const desc = ev.description ? (ev.description[lang] || ev.description[defaultLang] || Object.values(ev.description)[0] || '') : '';
                        
                        $('#modalEventDate').text(ev.date);
                        $('#modalEventTitle').text(title);
                        $('#modalEventType').text(formatEventTypeName(ev.type));
                        $('#modalEventDescription').html(desc);
                        
                        var myModal = new bootstrap.Modal(document.getElementById('academicEventModal'));
                        myModal.show();
                    }
                });
            }

            // Populate Year select
            let yearHtml = '';
            for (let y = currentYear - 5; y <= currentYear + 5; y++) {
                yearHtml += `<option value="${y}">${y}</option>`;
            }
            $('#acYearSelect').html(yearHtml);
            $('#acYearSelect').val(currentYear);
            $('#acMonthSelect').val(currentMonth);

            $('#acMonthSelect').change(function() {
                currentMonth = parseInt($(this).val());
                fetchEvents(currentYear, currentMonth);
            });

            $('#acYearSelect').change(function() {
                currentYear = parseInt($(this).val());
                fetchEvents(currentYear, currentMonth);
            });

            $('#acPrevMonth').click(function() {
                currentMonth--;
                if (currentMonth < 1) {
                    currentMonth = 12;
                    currentYear--;
                    $('#acYearSelect').val(currentYear);
                }
                $('#acMonthSelect').val(currentMonth);
                fetchEvents(currentYear, currentMonth);
            });

            $('#acNextMonth').click(function() {
                currentMonth++;
                if (currentMonth > 12) {
                    currentMonth = 1;
                    currentYear++;
                    $('#acYearSelect').val(currentYear);
                }
                $('#acMonthSelect').val(currentMonth);
                fetchEvents(currentYear, currentMonth);
            });

            // Initial fetch
            fetchEvents(currentYear, currentMonth);
        });
    </script>
    @endpush
