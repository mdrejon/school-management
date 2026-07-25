@extends('frontend.layouts.app')

@section('title', ($pageSettings->seo_title ?: $pageSettings->breadcrumb_title ?: 'Notice') . ' - ' . config('app.name'))
@section('meta_description', $pageSettings->seo_description ?: '')

@section('content')
    <main class="wexnix_main">

        <!-- breadcrumb -->
        <div class="wexnix_site-breadcrumb" style="background: url({{ $pageSettings->breadcrumb_image_url ?? '/frontend/assets/img/breadcrumb/01.jpg' }})">
            <div class="container">
                <h2 class="wexnix_breadcrumb-title">{{ $pageSettings->breadcrumb_title ?: 'Notice' }}</h2>
                <ul class="wexnix_breadcrumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="active">{{ $pageSettings->breadcrumb_title ?: 'Notice' }}</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- notice list -->
        <div class="pt-80 pb-80">
            <div class="container">
                <div class="row justify-content-end mb-4">
                    <div class="col-md-5 col-lg-4">
                        <form action="{{ route('notices.index') }}" method="GET" class="d-flex">
                            <input type="search" name="q" value="{{ $search }}" class="form-control" placeholder="Search Notice...">
                            <button type="submit" class="wexnix_theme-btn ms-2"><span class="fas fa-search"></span>Search</button>
                        </form>
                    </div>
                </div>

                @if ($notices->count())
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle wexnix_notice-table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Notice Title</th>
                                    <th>Publish Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($notices as $notice)
                                    <tr>
                                        <td>{{ str_pad($notices->firstItem() + $loop->index, 2, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ $notice->title }}</td>
                                        <td>{{ $notice->published_at?->format('d M, Y') }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('notices.show', $notice) }}" class="wexnix_theme-btn"><span class="fas fa-eye"></span>View</a>
                                            @if ($notice->pdf_url)
                                                <a href="{{ $notice->pdf_url }}" target="_blank" class="wexnix_theme-btn ms-1"><span class="fas fa-download"></span>PDF</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- pagination -->
                    {{ $notices->links('frontend.pagination.wexnix') }}
                    <!-- pagination end -->
                @else
                    <p class="text-center">No notices available right now — please check back soon.</p>
                @endif
            </div>
        </div>
        <!-- notice list end -->

    </main>
@endsection
