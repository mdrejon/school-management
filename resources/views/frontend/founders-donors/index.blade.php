@extends('frontend.layouts.app')

@section('title', ($pageSettings->seo_title ?: $pageSettings->breadcrumb_title ?: 'Founder & Donor List') . ' - ' . config('app.name'))
@section('meta_description', $pageSettings->seo_description ?: '')

@section('content')
    <main class="wexnix_main">

        <!-- breadcrumb -->
        <div class="wexnix_site-breadcrumb" style="background: url({{ $pageSettings->breadcrumb_image_url ?? '/frontend/assets/img/breadcrumb/01.jpg' }})">
            <div class="container">
                <h2 class="wexnix_breadcrumb-title">{{ $pageSettings->breadcrumb_title ?: 'Founder & Donor List' }}</h2>
                <ul class="wexnix_breadcrumb-menu">
                    <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li class="active">{{ $pageSettings->breadcrumb_title ?: 'Founder & Donor List' }}</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- page content -->
        <div class="pt-120 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 mx-auto">
                        @if ($pageSettings->section_title)
                            @php
                                $titleHtml = e($pageSettings->section_title);
                                if (! empty($pageSettings->section_highlight)) {
                                    $titleHtml = str_ireplace(e($pageSettings->section_highlight), '<span>' . e($pageSettings->section_highlight) . '</span>', $titleHtml);
                                }
                            @endphp
                            <div class="wexnix_site-heading mb-3">
                                @if ($pageSettings->section_tagline)
                                    <span class="wexnix_site-title-tagline"><i class="fas fa-book-open-reader"></i> {{ $pageSettings->section_tagline }}</span>
                                @endif
                                <h2 class="wexnix_site-title">{!! $titleHtml !!}</h2>
                                @if ($pageSettings->section_description)
                                    <p>{{ $pageSettings->section_description }}</p>
                                @endif
                            </div>
                        @endif

                        <div class="wexnix_tuition-fee-table">
                            @if ($founders->count())
                                <h4 class="my-4">{{ $pageSettings->founders_table_title ?: 'Founding Members' }}</h4>
                                <div class="table-responsive">
                                    <table class="table table-light">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">{{ __('Name') }}</th>
                                                <th scope="col">{{ __('Designation') }}</th>
                                                <th scope="col">{{ __('Year') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($founders as $founder)
                                                <tr>
                                                    <td>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT') }}</td>
                                                    <td>{{ $founder->name }}</td>
                                                    <td>{{ $founder->designation }}</td>
                                                    <td>{{ $founder->year }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif

                            @if ($donors->count())
                                <h4 class="my-4">{{ $pageSettings->donors_table_title ?: 'Honorable Donors' }}</h4>
                                <div class="table-responsive">
                                    <table class="table table-light">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">{{ __('Name') }}</th>
                                                <th scope="col">{{ __('Contribution') }}</th>
                                                <th scope="col">{{ __('Year') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($donors as $donor)
                                                <tr>
                                                    <td>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT') }}</td>
                                                    <td>{{ $donor->name }}</td>
                                                    <td>{{ $donor->contribution }}</td>
                                                    <td>{{ $donor->year }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif

                            @if (! $founders->count() && ! $donors->count())
                                <p class="text-center">{{ __('No founders or donors listed right now — please check back soon.') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- page content end -->

    </main>
@endsection
