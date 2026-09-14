@extends('frontend.layouts.app')

@section('title', ($pageSettings?->seo_title ?: 'Academic Calendar') . ' - ' . config('app.name'))
@section('meta_description', $pageSettings?->seo_description ?: '')

@section('content')
<main class="wexnix_main">
    <!-- breadcrumb -->
    <div class="wexnix_site-breadcrumb" style="background: url({{ $pageSettings?->breadcrumb_image_url ?? '/frontend/assets/img/breadcrumb/01.jpg' }})">
        <div class="container">
            <h2 class="wexnix_breadcrumb-title">{{ $pageSettings?->title ?: 'Academic Calendar' }}</h2>
            <ul class="wexnix_breadcrumb-menu">
                <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                <li class="active">{{ $pageSettings?->title ?: 'Academic Calendar' }}</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb end -->

    <div class="py-120">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <style>
                        .fs-calendar-wrapper {
                            background: #fff;
                            border-radius: 10px;
                            box-shadow: 0 5px 25px rgba(0,0,0,0.05);
                            padding: 40px;
                        }
                        .fs-cal-head {
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                            margin-bottom: 30px;
                        }
                        .fs-cal-head select {
                            font-size: 1.5rem;
                            font-weight: 700;
                            cursor: pointer;
                            border: none;
                            background: transparent;
                            box-shadow: none !important;
                            outline: none;
                            appearance: auto;
                            color: var(--body-text-color);
                        }
                        .fs-cal-head select:focus {
                            outline: none;
                            box-shadow: none;
                        }
                        .fs-cal-head button {
                            font-size: 1.5rem;
                            color: var(--theme-color);
                        }
                        .fs-cal-grid {
                            display: grid;
                            grid-template-columns: repeat(7, 1fr);
                            gap: 15px;
                            text-align: center;
                        }
                        .fs-cal-dow {
                            font-size: 1.1rem;
                            font-weight: 700;
                            color: var(--theme-color2);
                            padding: 15px 0;
                            border-bottom: 2px solid #eee;
                        }
                        .fs-cal-day {
                            font-size: 1.2rem;
                            padding: 25px 0;
                            border-radius: 10px;
                            color: var(--body-text-color);
                            position: relative;
                            background: #f8f9fa;
                            transition: all 0.3s;
                        }
                        .fs-cal-day:not(.fs-cal-empty):not(.fs-cal-today):not(.fs-cal-event):hover {
                            background: #e9ecef;
                        }
                        .fs-cal-empty {
                            visibility: hidden;
                        }
                        .fs-cal-event {
                            border: 2px solid var(--theme-color2);
                            color: var(--theme-color2);
                            font-weight: 700;
                            cursor: pointer;
                        }
                        .fs-cal-event:hover {
                            background: var(--theme-color2);
                            color: #fff;
                        }
                        .fs-cal-event:hover::after {
                            background: #fff;
                        }
                        .fs-cal-event::after {
                            content: "";
                            position: absolute;
                            bottom: 10px;
                            left: 50%;
                            transform: translateX(-50%);
                            width: 6px;
                            height: 6px;
                            border-radius: 50%;
                            background: var(--theme-color2);
                            transition: all 0.3s;
                        }
                        .fs-cal-today {
                            background: var(--theme-color) !important;
                            color: #fff !important;
                            font-weight: 700;
                        }
                        .fs-cal-legend {
                            display: flex;
                            gap: 30px;
                            justify-content: center;
                            margin-top: 40px;
                            font-size: 1.1rem;
                            font-weight: 600;
                        }
                        .fs-dot {
                            display: inline-block;
                            width: 14px;
                            height: 14px;
                            border-radius: 50%;
                            margin-right: 8px;
                        }
                        .fs-dot-today { background: var(--theme-color); }
                        .fs-dot-event { background: var(--theme-color2); }

                        @media (max-width: 768px) {
                            .fs-calendar-wrapper { padding: 20px; }
                            .fs-cal-grid { gap: 8px; }
                            .fs-cal-day { padding: 15px 0; font-size: 1rem; }
                            .fs-cal-dow { padding: 10px 0; font-size: 0.9rem; }
                            .fs-cal-head select { font-size: 1.2rem; }
                        }
                        @media (max-width: 480px) {
                            .fs-cal-grid { gap: 5px; }
                            .fs-cal-day { padding: 10px 0; font-size: 0.9rem; }
                            .fs-cal-dow { font-size: 0.8rem; }
                        }
                    </style>

                    <div class="fs-calendar-wrapper">
                        <div class="fs-cal-head">
                            <button type="button" id="fsPrevMonth" class="btn btn-link text-decoration-none p-2"><i class="fas fa-chevron-left"></i></button>
                            <div class="d-flex justify-content-center align-items-center">
                                <select id="fsMonthSelect" class="form-select border-0 w-auto pe-4 me-2">
                                    <option value="1">{{ __('January') }}</option>
                                    <option value="2">{{ __('February') }}</option>
                                    <option value="3">{{ __('March') }}</option>
                                    <option value="4">{{ __('April') }}</option>
                                    <option value="5">{{ __('May') }}</option>
                                    <option value="6">{{ __('June') }}</option>
                                    <option value="7">{{ __('July') }}</option>
                                    <option value="8">{{ __('August') }}</option>
                                    <option value="9">{{ __('September') }}</option>
                                    <option value="10">{{ __('October') }}</option>
                                    <option value="11">{{ __('November') }}</option>
                                    <option value="12">{{ __('December') }}</option>
                                </select>
                                <select id="fsYearSelect" class="form-select border-0 w-auto pe-4"></select>
                            </div>
                            <button type="button" id="fsNextMonth" class="btn btn-link text-decoration-none p-2"><i class="fas fa-chevron-right"></i></button>
                        </div>
                        <div class="fs-cal-grid" id="fsGrid">
                            <!-- Populated by JS -->
                        </div>
                        <div class="fs-cal-legend">
                            <span><span class="fs-dot fs-dot-today"></span> {{ __('Today') }}</span>
                            <span><span class="fs-dot fs-dot-event"></span> {{ __('Event') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Event Detail Modal -->
<div class="modal fade" id="fsEventModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fsEventModalLabel">{{ __('Event Details') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6 id="fsModalEventDate" class="text-primary mb-2"></h6>
                <h5 id="fsModalEventTitle" class="mb-3"></h5>
                <span id="fsModalEventType" class="badge bg-secondary mb-3"></span>
                <div id="fsModalEventDescription" class="text-muted"></div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
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
            $('#fsMonthSelect').val(month);
            $('#fsYearSelect').val(year);

            let html = `
                <span class="fs-cal-dow">Mo</span>
                <span class="fs-cal-dow">Tu</span>
                <span class="fs-cal-dow">We</span>
                <span class="fs-cal-dow">Th</span>
                <span class="fs-cal-dow">Fr</span>
                <span class="fs-cal-dow">Sa</span>
                <span class="fs-cal-dow">Su</span>
            `;

            const firstDay = new Date(year, month - 1, 1).getDay();
            let dayOfWeek = firstDay === 0 ? 7 : firstDay;
            const daysInMonth = new Date(year, month, 0).getDate();
            
            const todayDate = new Date();
            const isCurrentMonth = todayDate.getFullYear() === year && (todayDate.getMonth() + 1) === month;
            const todayDay = todayDate.getDate();

            for (let i = 1; i < dayOfWeek; i++) {
                html += `<span class="fs-cal-day fs-cal-empty"></span>`;
            }

            for (let day = 1; day <= daysInMonth; day++) {
                let isToday = isCurrentMonth && day === todayDay;
                
                let dayDateString = `${year}-${String(month).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                let dayEvents = eventsData.filter(e => e.date === dayDateString);
                let hasEvent = dayEvents.length > 0;
                
                let classes = 'fs-cal-day';
                if (isToday) classes += ' fs-cal-today';
                if (hasEvent) classes += ' fs-cal-event';

                let dataAttr = hasEvent ? ` data-date="${dayDateString}"` : '';

                html += `<span class="${classes}"${dataAttr}>${day}</span>`;
            }

            $('#fsGrid').html(html);

            $('.fs-cal-event').off('click').on('click', function() {
                const dateStr = $(this).data('date');
                const evs = eventsData.filter(e => e.date === dateStr);
                if (evs.length > 0) {
                    const ev = evs[0];
                    const defaultLang = '{{ config('app.fallback_locale', 'en') }}';
                    
                    const title = ev.title[lang] || ev.title[defaultLang] || Object.values(ev.title)[0] || '';
                    const desc = ev.description ? (ev.description[lang] || ev.description[defaultLang] || Object.values(ev.description)[0] || '') : '';
                    
                    $('#fsModalEventDate').text(ev.date);
                    $('#fsModalEventTitle').text(title);
                    $('#fsModalEventType').text(formatEventTypeName(ev.type));
                    $('#fsModalEventDescription').html(desc);
                    
                    var myModal = new bootstrap.Modal(document.getElementById('fsEventModal'));
                    myModal.show();
                }
            });
        }

        let yearHtml = '';
        for (let y = currentYear - 5; y <= currentYear + 5; y++) {
            yearHtml += `<option value="${y}">${y}</option>`;
        }
        $('#fsYearSelect').html(yearHtml);
        $('#fsYearSelect').val(currentYear);
        $('#fsMonthSelect').val(currentMonth);

        $('#fsMonthSelect').change(function() {
            currentMonth = parseInt($(this).val());
            fetchEvents(currentYear, currentMonth);
        });

        $('#fsYearSelect').change(function() {
            currentYear = parseInt($(this).val());
            fetchEvents(currentYear, currentMonth);
        });

        $('#fsPrevMonth').click(function() {
            currentMonth--;
            if (currentMonth < 1) {
                currentMonth = 12;
                currentYear--;
                $('#fsYearSelect').val(currentYear);
            }
            $('#fsMonthSelect').val(currentMonth);
            fetchEvents(currentYear, currentMonth);
        });

        $('#fsNextMonth').click(function() {
            currentMonth++;
            if (currentMonth > 12) {
                currentMonth = 1;
                currentYear++;
                $('#fsYearSelect').val(currentYear);
            }
            $('#fsMonthSelect').val(currentMonth);
            fetchEvents(currentYear, currentMonth);
        });

        fetchEvents(currentYear, currentMonth);
    });
</script>
@endpush
