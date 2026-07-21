{{-- Grid-column-wrapped department card — used by the departments list page. --}}
{{-- Expects: $department (App\Models\Department). --}}
<div class="col-lg-3">
    @include('frontend.departments.partials.item', ['department' => $department])
</div>
