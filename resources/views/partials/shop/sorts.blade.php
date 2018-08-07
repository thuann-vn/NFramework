<form action="{{request()->fullUrl()}}" method="get" class="sort-form">
    <button type="button" class="button mobile-filter-toggle" id="mobileSidebarToggle">{{__('frontend.category.filter')}}</button>
    <strong>{{__('frontend.category.sort')}}: </strong>
    <select name="sort" id="searchSortDropdown" class="form-control">
        <option value="featured" {{$sort=='featured'?'selected':''}}>{{__('frontend.category.sorts.featured')}}</option>
        <option value="best_seller" {{$sort=='best_seller'?'selected':''}}>{{__('frontend.category.sorts.best_sellers')}}</option>
        <option value="newest" {{$sort=='newest'?'selected':''}}>{{__('frontend.category.sorts.newest')}}</option>
        <option value="low_high" {{$sort=='low_high'?'selected':''}}>{{__('frontend.category.sorts.low_to_high')}}</option>
        <option value="high_low" {{$sort=='high_low'?'selected':''}}>{{__('frontend.category.sorts.high_to_low')}}</option>
    </select>
</form>