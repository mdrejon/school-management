{{-- Grid-column-wrapped event card — used by the events list page. --}}
{{-- Expects: $event (App\Models\Event). --}}
<div class="col-lg-4">
    @include('frontend.events.partials.item', ['event' => $event])
</div>
